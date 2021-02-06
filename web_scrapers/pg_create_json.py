import csv
import json
import os
import re
from subprocess import call
from datetime import datetime
from shutil import copyfile
from guess_language import guess_language
from argparse import ArgumentParser
from enum import Enum, auto

import literals
import pdf_helpers
from utils import clean_whitespace, clean_str, replace_bullets

class ReadingMode(Enum):
    TITLE = auto()
    PRESIDENTS = auto()
    PRESIDENTS_SKIP_NEXT = auto()
    SEKRETARIAT = auto()
    ZWECK = auto()
    ART_DER_AKTIVITAETEN = auto()
    MITGLIEDERLISTE = auto()


def is_president(line):
    return any(map(line.startswith, literals.president_mapping)) or line.startswith('Co- ')

def extract_president_title(line):
    title = None
    if ':' in line:
        title = line.split(':')[0]
    else:
        # Clean in case of missing :
        for keyword in literals.president_mapping:
            if keyword in line:
                title = keyword
                break

    if not title:
        print('No title found found in line "{}". Abort'.format(line))
        exit(1)

    return title.strip()

# Split as well for Italien ' e ', case "CN Anna Giacometti e CN Marco Romano"
def extract_presidents(line):
    if ':' in line:
        line = line.split(':')[1]
    # Clean in case of missing :
    for keyword in literals.president_mapping:
        line = line.replace(keyword, '')
    names = re.split(r',| e |;', line)
    names = [re.sub(r'(Nationalratspräsidentin|Nationalratspräsident|Vizepräsident des Nationalrates|des Nationalrates|Vizepräsidentin des Nationalrates|Nationalrätin|Nationalrat|CN|Conseillère nationale|Conseiller national|Cusseglier naziunal)\s', 'NR ', re.sub(r'(Ständeratspräsidentin|Ständeratspräsident|Vizepräsident des Ständerates|Vizepräsidentin des Ständerates|des Ständerates|Ständerätin|Ständerat|CE|Conseillère aux Etats|Conseiller aux Etats)\s', 'SR ', re.sub(r'(Herr|Frau|Monsieur le|Madame la|Dr.|Co-)', '', name))).strip() for name in names if name.strip() not in ['', "vakant", "Vakant", "folgt", "Noch offen", "(wird angestrebt, 2. Person ist noch vakant)", "(wird angestrebt", "2. Person ist noch vakant)"]]
    return names


def is_sekretariat(line):
    return line.startswith('Sekretariat:') or line.startswith('Co-Sekretariat:') or line.startswith("Sekretariate:")


def extract_sekretariat(line):
    if ':' in line and '://' not in line:
        line = line.split(':')[1]

    address_rows = re.split(r'•|\|\s+/\s+$|\s+/\s+|,|;', line)
    address_rows = [address_row.strip() for address_row in address_rows if address_row != '']
    address_rows = [address_row
                    for index, address_row
                    in enumerate(address_rows)
                    if not all(map(lambda line : re.sub(r'\d', '', line).strip() == "",
                        address_rows[index:]))
                    ]
    return address_rows


# read the csv generated by tabula and parse the groups and their members
def read_groups(filename):
    groups = []
    rows = csv.reader(open(filename, encoding="utf-8"))

    is_new_page = True
    page = 1
    reading_mode = None
    titles = []
    presidents = []
    sekretariat = []
    konstituierung = None
    zweck = []
    art_der_aktivitaeten = []
    mitglieder = []
    president_titles = set()

    lines = [clean_whitespace(clean_str(' '.join(row))) for row in rows if ''.join(row).strip() != '']
    for i, line in enumerate(lines):

        match_page = re.search(r'Seite\s*(\d+)\s*/\s*\d+', line)
        if line == '' or line.startswith('Fortsetzung:') or line.lower() in ['folgt', 'vakant']:
            continue
        elif match_page:
            is_new_page = True
            new_page = match_page.group(1)
            assert page + 1 != new_page, "Page numbers not succeding, current={}, new={}".format(page, new_page)
            page = int(new_page)
            continue

        if i < len(lines) - 2:
            next_line = lines[i + 1]

        if is_new_page:
            is_new_page = False
            if line.startswith('Mitgliederliste'):
                # not a new group on the new page
                continue
            elif line.startswith(('NR', 'SR')) or next_line.startswith(('NR', 'SR')):
                # continue normally as it is a group member
                pass
            else:
                # save previous page
                if titles:
                    if not presidents:
                        print("-- WARN: no presidents for group '{}'".format(titles[0]))
                    groups.append((titles, presidents, sekretariat, konstituierung, zweck, art_der_aktivitaeten, mitglieder))
                reading_mode = ReadingMode.TITLE
                titles = []
                presidents = []
                sekretariat = []
                konstituierung = None
                zweck = []
                art_der_aktivitaeten = []
                mitglieder = []

        # reading_mode checks must be in reverse order as in the document
        if line.startswith('Mitgliederliste'):
            reading_mode = ReadingMode.MITGLIEDERLISTE

        elif line.startswith('Konstituierung:'):
            reading_mode = None
            str = line.replace('Konstituierung:', '').replace('Le', '').replace(', cf courrier de création en 3 langues ci-joint', '').replace('in Bern', '').strip()
            if str and not str in ['--', '-']:
                konstituierung = str

        elif line.startswith('Art der ') or reading_mode == ReadingMode.ART_DER_AKTIVITAETEN:
            reading_mode = ReadingMode.ART_DER_AKTIVITAETEN
            str = replace_bullets(re.sub(r'(Art der|geplanten|Aktivitäten:)', '', line))
            if str:
                art_der_aktivitaeten.append(str)

        elif line.startswith('Zweck:') or reading_mode == ReadingMode.ZWECK:
            reading_mode = ReadingMode.ZWECK
            text = replace_bullets(line.replace('Zweck:', '').replace('--', ''))
            if text:
                zweck.append(text)

        elif is_sekretariat(line) or reading_mode == ReadingMode.SEKRETARIAT:
            reading_mode = ReadingMode.SEKRETARIAT
            sekretariat += extract_sekretariat(line)

        # avoid reading on second line, case separete Co-, second line PräsidentInnen (PG Mehrsprachigkeit CH)
        elif is_president(line) and reading_mode != ReadingMode.PRESIDENTS_SKIP_NEXT:
            if line.startswith('Co- '):
                reading_mode = ReadingMode.PRESIDENTS_SKIP_NEXT
                president_title = extract_president_title('Co-' + next_line)
            else:
                reading_mode = ReadingMode.PRESIDENTS
                president_title = extract_president_title(line)
            president_titles.add(president_title)
            for president in extract_presidents(line):
                presidents.append((fix_parlamentarian_name_typos(president), president_title))

        elif reading_mode == ReadingMode.PRESIDENTS or reading_mode == ReadingMode.PRESIDENTS_SKIP_NEXT:
            reading_mode = ReadingMode.PRESIDENTS
            for president in extract_presidents(line):
                presidents.append((fix_parlamentarian_name_typos(president), president_title))

        elif reading_mode == ReadingMode.MITGLIEDERLISTE and (line.startswith('NR') or line.startswith('SR')):
            mitglieder.append((fix_parlamentarian_name_typos(line), None))

        elif reading_mode == ReadingMode.TITLE:
            titles.append(line)

    # save last page
    if titles and presidents:
        groups.append((titles, presidents, sekretariat, konstituierung, zweck, art_der_aktivitaeten, mitglieder))

    # print counts for sanity check
    print("\n{} parlamentarische Gruppen\n"
          "{} total members of parlamentarische Gruppen".format(
              len(groups),
              sum(len(gruppe) for gruppe in groups)))

    return groups

# The PDF containing the co-presidents of the parlamentarische Gruppen
# has spelling errors in certain names. Correct them here:
def fix_parlamentarian_name_typos(name):
    return name.replace("Margrit Kiener Nellen", "Margret Kiener Nellen").replace("Matthias Reynard", "Mathias Reynard").replace("Isabelle Chevallay", "Isabelle Chevalley").replace("Juerg", "Jürg").replace('Prisca Seiler Graf', 'Priska Seiler Graf').replace('Buillard-Marbach', 'Bulliard-Marbach').replace('Bulliard-Marchbach', 'Bulliard-Marbach').replace('Buillard', 'Bulliard').replace('Herzog Evy', 'Herzog Eva').replace('Levraz', 'Levrat').replace('Levart', 'Levrat').replace('Candidas', 'Candinas').replace('de Quatro', 'de Quattro').replace('Pieren Nadja', 'Umbricht Pieren Nadja').replace('Barille', 'Barrile').replace('Julliard', 'Juillard').replace('Funicello','Funiciello').replace('Franzsiska', 'Franziska')
    #.replace('Schlatter-Schmid', 'Schlatter').replace('Rüegger-Hurschler', 'Rüegger')

def normalize_namen(groups):
    new_groups = []
    for titles, members, sekretariat, konstituierung, zweck, art_der_aktivitaeten, mitgliederliste in groups:
        title_de = titles[0]
        title_fr = titles[1] if len(titles) > 1 else None
        title_it = titles[2] if len(titles) > 2 else None

        if (title_fr and not guess_language(title_fr, ['de', 'fr', 'it']) in ['fr', 'UNKNOWN']):
            print("Warning: title_fr '{}' guess lanuage is guessed '{}'\n".format(title_fr, guess_language(title_fr, ['de', 'fr', 'it'])))
        if (title_it and not guess_language(title_it, ['de', 'fr', 'it']) in ['it', 'UNKNOWN']):
            print("Warning: title_it '{}' guess lanuage is guessed '{}'\n".format(title_it, guess_language(title_it, ['de', 'fr', 'it'])))

        new_groups.append((clean_whitespace(title_de), clean_whitespace(title_fr), clean_whitespace(title_it), members, sekretariat, konstituierung, zweck, art_der_aktivitaeten, mitgliederliste))
    return new_groups

# write member of parliament and guests to json file
def write_to_json(groups, archive_pdf_name, filename, url, creation_date, imported_date):
    data = [{
            "name_de": title_de,
            "name_fr": title_fr,
            "name_it": title_it,
            "praesidium": members,
            "sekretariat": sekretariat,
            "konstituierung": konstituierung,
            "zweck": zweck,
            "art_der_aktivitaeten": art_der_aktivitaeten,
            "mitglieder": mitgliederliste
            } for (title_de, title_fr, title_it, members, sekretariat, konstituierung, zweck, art_der_aktivitaeten, mitgliederliste) in groups]

    metadata_data = {
                "metadata": {
                    "archive_pdf_name": archive_pdf_name,
                    "filename": filename,
                    "url": url,
                    "pdf_creation_date": creation_date.isoformat(' '), # , timespec='minutes'
                    "imported_date": imported_date.isoformat(' ')
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

    url = "https://www.parlament.ch/centers/documents/de/gruppen-der-bundesversammlung.pdf"
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

        print("removing first page of PDF...")
        stripped_file_name = "pg_file-stripped.pdf"
        call(["qpdf", "--pages", pdf_name, "2-z", "--", pdf_name, stripped_file_name])

        print("parsing PDF...")
        tabula_path = script_path + "/tabula-1.0.4-jar-with-dependencies.jar"
        cmd = ["java", "-Djava.util.logging.config.file=web_scrapers/logging.properties", "-jar", tabula_path, stripped_file_name, "-o", "pg_data.csv", "--pages", "all", "-t", "-i"]
        print(" ".join(cmd))
        call(cmd, stderr=None)

        print("reading parsed data...")
        groups = read_groups("pg_data.csv")
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
        os.remove(stripped_file_name)
        os.remove("pg_data.csv")


#main method
if __name__ == "__main__":
    scrape()
