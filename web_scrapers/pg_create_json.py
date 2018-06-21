# -*- coding: utf-8 -*-


# A script that imports PDFs that are on the site of the government that
# indicate which member of the two Swiss parliaments are in which
# parlamentarische Gruppe

# Since the information is only provided as PDF documents that are not easily
# machine-readable, this script translates the PDF into a JSON document hat can
# then be used for further automation.

# Created by Markus Roth in June 2018 (maroth@gmail.com)
# Licensed via Affero GPL v3

import csv
import json
import os
import re
import datetime
from subprocess import call
from datetime import datetime
from collections import defaultdict
from shutil import copyfile

from pdf_helpers import extract_creation_date, get_pdf_from_admin_ch

president_title = ['Präsident', 'Präsidentin', 'Co-Präsidium', 'Co-Präsident', 'Co-Präsidentin']

def is_title(row):
    row = ' '.join(row)
    number = row.split('.')[0]
    return re.match('^\d+$', number)

def is_end(row):
    return "".join(row).startswith("Die Liste ist ebenfalls auf Internet abrufbar")


def extract_title(row):
    row = ' '.join(row).strip()
    row = row.split('.')[1]
    return row.strip()


def is_president(row):
    row = ' '.join(row).strip()
    return any(map(row.startswith, president_title))


def extract_presidents(row):
    row = ' '.join(row)
    if ':' in row:
        row = row.split(':')[1]
    names = row.split(',')
    names = [name.strip() for name in names if name.strip() != '' and name.strip() != "vakant"]
    names = [name.replace("Dr.", "").replace("vakant", "").replace(";", "") for name in names]
    print(names)
    return names


def is_sekretariat(row):
    row = ''.join(row)
    return row.startswith('Sekretariat:') or row.startswith('Co-Sekretariat:')


# read the csv generated by tabula and parse the groups and their members
def cleanup_file(filename):
    groups = {}
    presidents = []
    group = ''
    reading_presidents = False
    rows = csv.reader(open(filename, encoding="utf-8"))
    for row in rows:
        print(row)

        if is_sekretariat(row):
            reading_presidents = False

        if is_title(row):
            if group and presidents:
                groups[group] = presidents
            presidents = []
            group = extract_title(row)

        if is_end(row):
            if group and presidents:
                groups[group] = presidents

        if is_president(row) or reading_presidents:
            presidents = presidents + extract_presidents(row)
            reading_presidents = True

    # print counts for sanity check
    print("{} parlamentarische Gruppen\n"
          "{} total members of parlamentarische Gruppen".format(
              len(groups),
              sum(len(gruppe) for gruppe in groups.values())))

    return groups 


# write member of parliament and guests to json file
def write_to_json(groups, archive_pdf_name, filename, url, creation_date, imported_date):
    data = [{
            "name": group,
            "members": members
            } for group, members in groups.items()]
            
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
def scrape():
    url = "https://www.parlament.ch/centers/documents/de/parlamentarische-gruppen.pdf"
    filename = "parlamentarische-gruppen.json"

    try:
        print("\ndownloading " + url)
        raw_pdf_name = url.split("/")[-1]
        import_date = datetime.now().replace(microsecond=0)
        pdf_name = "{}-{:02d}-{:02d}-{}".format(import_date.year, import_date.month, import_date.day, raw_pdf_name)
        get_pdf_from_admin_ch(url, pdf_name)

        print("\nextracting metadata...")
        creation_date = extract_creation_date(pdf_name)
        archive_pdf_name = "{}-{:02d}-{:02d}-{}".format(creation_date.year, creation_date.month, creation_date.day, raw_pdf_name)
        archive_filename = "{}-{:02d}-{:02d}-{}".format(creation_date.year, creation_date.month, creation_date.day, filename)
        print("\nPDF creation date: {:02d}.{:02d}.{}\n".format(creation_date.day, creation_date.month, creation_date.year))

        print("parsing PDF...")
        FNULL = open(os.devnull, 'w')
        call(["java", "-jar", get_script_path() + "/tabula-0.9.2-jar-with-dependencies.jar",
            pdf_name, "--pages", "all", "-o", "pg_data.csv"], stderr=FNULL)

        print("cleaning up parsed data...")
        groups = cleanup_file("pg_data.csv")

        print("writing " + filename + "...")
        write_to_json(groups, archive_pdf_name, filename, url, creation_date, import_date)

        print("archiving...")
        copyfile(pdf_name, get_script_path() + "/archive/{}".format(archive_pdf_name))
        copyfile(filename, get_script_path() + "/archive/{}".format(archive_filename))

    finally:
        print("cleaning up...")
        os.rename(pdf_name, get_script_path() + "/backup/{}".format(pdf_name))
        backup_filename = "{}-{:02d}-{:02d}-{}".format(import_date.year, import_date.month, import_date.day, filename)
        copyfile(filename, get_script_path() + "/backup/{}".format(backup_filename))
        os.remove("pg_data.csv")



#main method
if __name__ == "__main__":
    scrape()
