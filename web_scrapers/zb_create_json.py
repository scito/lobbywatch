# -*- coding: utf-8 -*-

import csv
import json
import os
import re
from subprocess import call
from datetime import datetime
from shutil import copyfile

import pdf_helpers

def split_names(names):
    return names.replace('"', "").replace(".", "").split(" ")


class Entity:
    # remove invalid characters from cell entries
    def clean_string(self, s):
        return s.replace("\n", " ")


# represents a member of parliament
class MemberOfParliament(Entity):
    def __init__(self, description):
        # members of parliament are formatted as
        # "[names], <party>/<canton>"
        # this entire description is passed into the constructor
        name_and_party = self.clean_string(description).split(",")
        full_name = name_and_party[0]
        self.names = split_names(full_name)

        party_and_canton = name_and_party[1].split("/")
        party = party_and_canton[0].strip()

        # The FDP can show up as "FDP-Liberale",
        # so we need to get only the part before the dash
        party_split = party.split("-")
        if len(party_split) == 1:
            self.party = party
        else:
            self.party = party_split[0]
        self.canton = party_and_canton[1]


# represents a guest of a member of parliament
class Guest(Entity):
    def __init__(self, name_raw, function):
        name = self.clean_string(name_raw)
        name = self.remove_title(name)
        name = self.fix_name_typos(name)
        self.names = split_names(name)
        self.function = self.clean_string(function)

    def fix_name_typos(self, name):
        return name.replace("Schürch Florence", "Schurch Florence")

    def remove_title(self, name):
        return re.sub(r'(Herr|Frau|Monsieur|Madame|Dr.)', '', name).strip()

# create a guest object from the passed csv row
# taking name and function from the passed indexes of the row
# if the row is not long enough, the function of the
# guest is missing
def create_guest(row, name_index, function_index):
    # guest has no name
    if (is_empty(row[name_index])):
        return None

    # guest has name and function
    if len(row) > function_index:
        return Guest(row[name_index], row[function_index])

    # guest has only a name, but no function
    else:
        return Guest(row[name_index], "")


# read the csv generated by tabula and get rid of empty rows and headers
def cleanup_file(filename):
    guests = {}
    current_member_of_parliament = None
    # in general, if row[0] is not empty, we are at a new member of
    # parliament. all guests from that row and the following rows belong
    # to that member of parliament, until a new name shows up in row[0].

    # but: sometimes tabula gets mixed up and puts the guest in row[0].
    # So we need to check if the first cell is a member of parliament
    # manually so we don't miss anything.
    for row in csv.reader(open(filename, encoding="utf-8")):
        if not is_header(row) and not is_empty_row(row):
            if is_empty(row[0]):
                # row[0] is empty
                # guest name is in row[1]
                # and guest function is in row[2]
                # for member of parliament defined in a previous row
                guest = create_guest(row, 1, 2)
                if guest is not None:
                    guests[current_member_of_parliament].append(guest)

            else:
                if is_member_of_parliament(row[0]):
                    # row[0] is member of parliament,
                    # row[1] and row[2] are guest name and function
                    current_member_of_parliament = MemberOfParliament(row[0])
                    guests[current_member_of_parliament] = []
                    guest = create_guest(row, 1, 2)
                    if guest is not None:
                        guests[current_member_of_parliament].append(guest)

                else:
                    # tabula messed up, so row[0] is the guest name
                    # and row[1] is the guest function
                    guest = create_guest(row, 0, 1)
                    if guest is not None:
                        guests[current_member_of_parliament].append(guest)

    # print counts for sanity check
    print("{} members of parliament\n"
          "{} guests total\n"
          "{} members with 0 guests\n"
          "{} members with 1 guest\n"
          "{} members with 2 guests".format(
              len(guests),
              sum(len(guest) for guest in guests.values()),
              sum(1 for guest in guests.values() if len(guest) == 0),
              sum(1 for guest in guests.values() if len(guest) == 1),
              sum(1 for guest in guests.values() if len(guest) == 2)))
    return guests


# is this table row a header row?
def is_header(row):
    if len(row) < 2:
        return True
    header_words = ["Partito", "Consigliere", "Fonction",
                    "Conseiller", "Funzionenktion", "Funktion",
                    "Funzione", "Name", "Partei / Kanton", "Funzionenktion,",
                    "Conseiller/,", "Parti / Canton", "Partito / Cantone",
                    "Ratsmitglied"]

    return any(header_word in row_entry
               for header_word in header_words
               for row_entry in row)


# is this table row empty?
def is_empty_row(row):
    return all(len(entry.strip()) == 0 for entry in row)


# is the field empty or contains only whitespace?
def is_empty(s):
    return len(s.strip()) == 0


def is_member_of_parliament(s):
    # members of parliament are formatted as
    # "<lastname <firstname>, <party>/<canton>"
    return "," in s and "/" in s


# write member of parliament and guests to json file
def write_to_json(guests, archive_pdf_name, filename, url, creation_date, imported_date):
    data = [{
            "names": member_of_parliament.names,
            "party": member_of_parliament.party,
            "canton": member_of_parliament.canton,
            "guests": [{
                "names": guest.names,
                "function": guest.function
                } for guest in current_guests]
            } for member_of_parliament, current_guests in guests.items()]

    metadata_data = {
                "metadata": {
                    "archive_pdf_name": archive_pdf_name,
                    "filename": filename,
                    "url": url,
                    "pdf_creation_date": creation_date.isoformat(' '), # , timespec is addedin Python 3.6: 'seconds'
                    "imported_date": imported_date.isoformat(' ') # , timespec is addedin Python 3.6: 'seconds'
                },
                "data": data
    }
    with open(filename, "wb") as json_file:
        contents = json.dumps(metadata_data, indent=4,
                              separators=(',', ': '),
                              ensure_ascii=False).encode("utf-8")
        json_file.write(contents)

# Get path of this python script
# http://stackoverflow.com/questions/4934806/how-can-i-find-scripts-directory-with-python
def get_script_path():
    return os.path.dirname(os.path.realpath(__file__))

# download a pdf containing the guest lists of members of parlament in a table
# then parse the file into json and save the json files to disk
def scrape_pdf(url, filename):
    try:
        print("\ndownloading " + url)
        raw_pdf_name = url.split("/")[-1]
        import_date = datetime.now().replace(microsecond=0)
        pdf_name = "{}-{:02d}-{:02d}-{}".format(import_date.year, import_date.month, import_date.day, raw_pdf_name)
        pdf_helpers.get_pdf_from_admin_ch(url, pdf_name)

        print("\nextracting metadata...")
        creation_date = pdf_helpers.extract_creation_date(pdf_name)
        archive_pdf_name = "{}-{:02d}-{:02d}-{}".format(creation_date.year, creation_date.month, creation_date.day, raw_pdf_name)
        archive_filename = "{}-{:02d}-{:02d}-{}".format(creation_date.year, creation_date.month, creation_date.day, filename)
        print("\nPDF creation date: {:02d}.{:02d}.{}\n".format(creation_date.day, creation_date.month, creation_date.year))

        print("removing first page of PDF...")
        call(["qpdf", "--pages", pdf_name, "2-z", "--", pdf_name, "zb_file-stripped.pdf"])

        print("parsing PDF...")
        call(["java", "-Djava.util.logging.config.file=web_scrapers/logging.properties", "-jar", get_script_path() + "/tabula-0.9.2-jar-with-dependencies.jar",
            "zb_file-stripped.pdf", "--pages", "all", "-o", "zb_data.csv"])

        print("cleaning up parsed data...")
        guests = cleanup_file("zb_data.csv")

        print("writing " + filename + "...")
        write_to_json(guests, archive_pdf_name, filename, url, creation_date, import_date)

        print("archiving...")
        copyfile(pdf_name, get_script_path() + "/archive/{}".format(archive_pdf_name))
        copyfile(filename, get_script_path() + "/archive/{}".format(archive_filename))

    finally:
        print("cleaning up...")
        os.rename(pdf_name, get_script_path() + "/backup/{}".format(pdf_name))
        backup_filename = "{}-{:02d}-{:02d}-{}".format(import_date.year, import_date.month, import_date.day, filename)
        copyfile(filename, get_script_path() + "/backup/{}".format(backup_filename))
        os.remove("zb_file-stripped.pdf")
        os.remove("zb_data.csv")

# scrape the nationalrat and ständerat guest lists and write them to
# structured JSON files
def scrape():
    root = "https://www.parlament.ch/centers/documents/de/"

    #scrape nationalrat
    scrape_pdf(root +
               "zutrittsberechtigte-nr.pdf",
               "zutrittsberechtigte-nr.json")

    #scrape ständerat
    scrape_pdf(root +
               "zutrittsberechtigte-sr.pdf",
               "zutrittsberechtigte-sr.json")


#main method
if __name__ == "__main__":
    scrape()
