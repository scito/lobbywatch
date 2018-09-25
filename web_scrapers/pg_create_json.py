# -*- coding: utf-8 -*-

import csv
import json
import os
import re
import datetime
from subprocess import call
from datetime import datetime
from collections import defaultdict
from shutil import copyfile
from guess_language import guess_language
from argparse import ArgumentParser

import literals 
import pdf_helpers 


def is_title(row):
    row = ' '.join(row)
    items = row.split('.')
    if len(items) < 2:
        return False
    number = items[0]
    return re.match(r'^\d+$', number) 


def is_end(row):
    return "Die Liste ist ebenfalls auf Internet abrufbar" in "".join(row)


def extract_title(row):
    if is_title(row):
        row = ' '.join(row)
        return row.split('.')[1].strip()
    else:
        row = ' '.join(row)
        return row.strip()


def add_to_title(row):
    row = ' '.join(row).strip()
    return row.strip()


def is_president(row):
    row = ' '.join(row).strip()
    return any(map(row.startswith, literals.president_title))


def extract_presidents(row):
    row = ' '.join(row)
    if ':' in row:
        row = row.split(':')[1]
    names = row.split(',')
    names = [name.strip() for name in names if name.strip() != '' and name.strip() != "vakant"]
    names = [name.replace("Dr.", "").replace("vakant", "").replace(";", "") for name in names]
    return names


def is_sekretariat(row):
    row = ''.join(row)
    return row.startswith('Sekretariat:') or row.startswith('Co-Sekretariat:') or row.startswith("Sekretariate:")


def extract_sekretariat(row):
    row = ' '.join(row)
    if ':' in row and "Homepage" not in row:
        row = row.split(':')[1]
    address_rows = row.split(',')
    address_rows = [address_row.strip() for address_row in address_rows if address_row != '']
    address_rows = [address_row 
                    for index, address_row 
                    in enumerate(address_rows)
                    if not all(map(lambda row : re.sub(r'\d', '', row).strip() == "", 
                        address_rows[index:]))
                    ]
    return address_rows


# read the csv generated by tabula and parse the groups and their members
def cleanup_file(filename):
    groups = []
    rows = csv.reader(open(filename, encoding="utf-8"))

    titles = []
    presidents = []
    sekretariat = []
    reading_title = False
    reading_presidents = False
    reading_sekretariat = False

    for row in rows:

        if is_title(row) and not reading_title:
            if titles and presidents:
                groups.append((titles, presidents, sekretariat))
            presidents = []
            sekretariat = []
            titles = []
            reading_title = True
            reading_sekretariat = False
            reading_presidents = False

        if is_end(row):
            if titles and presidents:
                groups.append((titles, presidents, sekretariat))
                break

        if is_sekretariat(row) or reading_sekretariat:
            reading_presidents = False
            reading_sekretariat = True
            reading_title = False
            sekretariat += extract_sekretariat(row)

        if is_president(row) or reading_presidents:
            presidents += (extract_presidents(row))
            reading_presidents = True
            reading_sekretariat = False
            reading_title = False

        if reading_title:
            titles.append(extract_title(row))


    # print counts for sanity check
    print("{} parlamentarische Gruppen\n"
          "{} total members of parlamentarische Gruppen".format(
              len(groups),
              sum(len(gruppe) for gruppe in groups)))

    return groups 

def normalize_namen(groups):
    new_groups = []
    for titles, members, sekretariat in groups:
        title_de = titles[0]
        title_fr = ""
        title_it = ""

        #The rumantsch group is the only group that is actually named in four seperate languages
        #Hack around it
        if "rumantscha" in titles[0] and len(titles) == 4:
            titles = titles[:-1]

        last_language = 'de'
        for title in titles[1:]:
            language = guess_language(title, ['de', 'fr', 'it'])
            if language == "de":
                title_de += title.strip()
            elif language == "fr":
                title_fr += title.strip()
            elif language == "it":
                title_it += title.strip()
            else:
                if last_language == "de":
                    title_de += " " + title.strip()
                elif last_language == "fr":
                    title_fr += " " + title.strip()
                elif last_language == "it":
                    title_it += " " + title.strip()

        new_groups.append((title_de, title_fr, title_it, members, sekretariat))
    return new_groups


# write member of parliament and guests to json file
def write_to_json(groups, archive_pdf_name, filename, url, creation_date, imported_date):
    data = [{
            "name_de": title_de,
            "name_fr": title_fr,
            "name_it": title_it,
            "praesidium": members,
            "sekretariat": sekretariat
            } for (title_de, title_fr, title_it, members, sekretariat) in groups]
            
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


# download a pdf containing the guest lists of members of parlament in a table
# then parse the file into json and save the json files to disk
def scrape():
    parser = ArgumentParser(description='Scarpe Parlamentarische Gruppen PDF')
    parser.add_argument("local_pdf", metavar="file", nargs='?', help="local PDF file to use", default=None)
    args = parser.parse_args()
    local_pdf = args.local_pdf

    url = "https://www.parlament.ch/centers/documents/de/parlamentarische-gruppen.pdf"
    filename = "parlamentarische-gruppen.json"

    script_path = os.path.dirname(os.path.realpath(__file__))
    try:
        import_date = datetime.now().replace(microsecond=0)
        raw_pdf_name = url.split("/")[-1]
        pdf_name = "{}-{:02d}-{:02d}-{}".format(import_date.year, import_date.month, import_date.day, raw_pdf_name)
        if local_pdf is None:
            print("\ndownloading " + url)
            pdf_helpers.get_pdf_from_admin_ch(url, pdf_name)
        else:
            print("\ncopy local PDF " + local_pdf)
            copyfile(local_pdf, pdf_name)

        print("\nextracting metadata...")
        creation_date = pdf_helpers.extract_creation_date(pdf_name)
        archive_pdf_name = "{}-{:02d}-{:02d}-{}".format(creation_date.year, creation_date.month, creation_date.day, raw_pdf_name)
        archive_filename = "{}-{:02d}-{:02d}-{}".format(creation_date.year, creation_date.month, creation_date.day, filename)
        print("\nPDF creation date: {:02d}.{:02d}.{}\n".format(creation_date.day, creation_date.month, creation_date.year))

        print("parsing PDF...")
        FNULL = open(os.devnull, 'w')
        tabula_path = script_path + "/tabula-0.9.2-jar-with-dependencies.jar"
        call(["java", "-jar", tabula_path, pdf_name, "--pages", "all", "-o", "pg_data.csv"], stderr=FNULL)

        print("cleaning up parsed data...")
        groups = cleanup_file("pg_data.csv")
        groups = normalize_namen(groups)

        print("writing " + filename + "...")
        write_to_json(groups, archive_pdf_name, filename, url, creation_date, import_date)

        if local_pdf is None:
            print("archiving...")
            copyfile(pdf_name, script_path + "/archive/{}".format(archive_pdf_name))
            copyfile(filename, script_path + "/archive/{}".format(archive_filename))

    finally:
        print("cleaning up...")
        os.rename(pdf_name, script_path + "/backup/{}".format(pdf_name))
        backup_filename = "{}-{:02d}-{:02d}-{}".format(import_date.year, import_date.month, import_date.day, filename)
        copyfile(filename, script_path + "/backup/{}".format(backup_filename))
        os.remove("pg_data.csv")



#main method
if __name__ == "__main__":
    scrape()
