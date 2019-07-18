# -*- coding: utf-8 -*-

import os

user = os.getenv('USER', 'auto')

# create new zutrittsberechtigung for a perlamentarier
def insert_zutrittsberechtigung(parlamentarier_id, person_id, funktion, date, pdf_date):
    query = "INSERT INTO `zutrittsberechtigung` (`parlamentarier_id`, `person_id`, `funktion`, `von`, `notizen`, `created_visa`, `created_date`, `updated_visa`, `updated_date`, `updated_by_import`) VALUES ({0}, {1}, '{2}', STR_TO_DATE('{3}', '%d.%m.%Y'), '{4}', '{5}', STR_TO_DATE('{6}', '%d.%m.%Y %T'), '{7}', STR_TO_DATE('{8}', '%d.%m.%Y %T'), STR_TO_DATE('{8}', '%d.%m.%Y %T'));\n".format(
            parlamentarier_id,
            person_id if person_id is not None else "(SELECT LAST_INSERT_ID())",
            funktion,
            _date_as_sql_string(date),
            "{0}/import/{1}: Erzeugt (PDF {2})".format(_date_as_sql_string(date), user, _datetime_as_sql_string(pdf_date)),
            "import",
            _datetime_as_sql_string(date),
            "import",
            _datetime_as_sql_string(date)
    )

    return query


# update the function of an existing zutrittsberechtigung
def update_function_of_zutrittsberechtigung(zutrittsberechtigung_id, function, date, pdf_date):
    query = "UPDATE `zutrittsberechtigung` SET `funktion` = '{0}', `notizen` = CONCAT_WS('\\n\\n', '{1}', notizen), `updated_visa` = '{2}', `updated_date` = STR_TO_DATE('{3}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{3}', '%d.%m.%Y %T') WHERE `id` = {4};\n".format(
        _escape_string(function),
        "{0}/import/{1}: Funktion geändert (PDF {2})".format(
            _date_as_sql_string(date), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(date),
        zutrittsberechtigung_id
    )

    return query


# end a zutrittsberechtigung
def end_zutrittsberechtigung(zutrittsberechtigung_id, date, pdf_date):
    query = "UPDATE `zutrittsberechtigung` SET `bis` = STR_TO_DATE('{0}', '%d.%m.%Y'), `notizen` = CONCAT_WS('\\n\\n', '{1}', notizen), `updated_visa` = '{2}', `updated_date` = STR_TO_DATE('{3}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{3}', '%d.%m.%Y %T') WHERE `id` = {4};\n".format(
        _date_as_sql_string(date),
        "{0}/import/{1}: Bis-Datum gesetzt (PDF {2})".format(
            _date_as_sql_string(date), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(date),
        zutrittsberechtigung_id
    )

    return query


# insert a new person
def insert_person(guest, date, pdf_date):
    query = "INSERT INTO `person` (`nachname`, `vorname`, `zweiter_vorname`, `beschreibung_de`, `created_visa`, `created_date`, `updated_visa`, `updated_date`, `updated_by_import`, `notizen`) VALUES ('{0}', '{1}', '{2}', '{3}', '{4}', STR_TO_DATE('{5}', '%d.%m.%Y %T'), '{6}', STR_TO_DATE('{7}', '%d.%m.%Y %T'), STR_TO_DATE('{7}', '%d.%m.%Y %T'), '{8}');\n".format(
            _escape_string(guest["names"][0]),
            _escape_string(guest["names"][1]),
            _escape_string(guest["names"][2] if len(
                guest["names"]) > 2 else ""),
            _escape_string(guest["function"]),
            "import",
            _datetime_as_sql_string(date),
            "import",
            _datetime_as_sql_string(date),
            "{0}/import/{1}: Erzeugt (PDF {2})".format(_date_as_sql_string(date), user,  _datetime_as_sql_string(pdf_date))
    )

    return query


# insert a new organisation with the characteristics of a parlamentarische gruppe
def insert_parlamentarische_gruppe(name_de, name_fr, name_it, sekretariat, adresse_str, adresse_zusatz, adresse_plz, adresse_ort, homepage, alias, date, pdf_date):
    query = """INSERT INTO `organisation` (`name_de`, `name_fr`, `name_it`, `sekretariat`, `adresse_strasse`, `adresse_zusatz`, `adresse_plz`, `ort`, `homepage`, `alias_namen_de`, `land_id`, `rechtsform`, `typ`, `vernehmlassung`, `created_visa`, `created_date`, `updated_visa`, `updated_by_import`, `notizen`, `eingabe_abgeschlossen_visa`, `eingabe_abgeschlossen_datum`) VALUES ('{}', {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, '{}', '{}', '{}', '{}', STR_TO_DATE('{}', '%d.%m.%Y %T'), '{}', STR_TO_DATE('{}', '%d.%m.%Y %T'), '{}', '{}', STR_TO_DATE('{}', '%d.%m.%Y %T'));
SET @last_parlamentarische_gruppe = LAST_INSERT_ID();
""".format(
            _escape_string(name_de),
            "'" + _escape_string(name_fr) + "'" if name_fr else 'NULL',
            "'" + _escape_string(name_it) + "'" if name_it else 'NULL',
            _quote_str_or_NULL(_escape_string(sekretariat)),
            _quote_str_or_NULL(_escape_string(adresse_str)),
            _quote_str_or_NULL(_escape_string(adresse_zusatz)),
            _quote_str_or_NULL(_escape_string(adresse_plz)),
            _quote_str_or_NULL(_escape_string(adresse_ort)),
            _quote_str_or_NULL(_escape_string(homepage)),
            _quote_str_or_NULL(_escape_string(alias)),
            191,  # Schweiz
            "Parlamentarische Gruppe",
            "EinzelOrganisation,dezidierteLobby",
            "nie",
            "import",
            _datetime_as_sql_string(date),
            "import",
            _datetime_as_sql_string(date),
            "{0}/import/{1}: Erzeugt (PDF {2})".format(_date_as_sql_string(date), user, _datetime_as_sql_string(pdf_date)),
            "import",
            _datetime_as_sql_string(date)
    )

    return query


def update_sekretariat_organisation(organisation_id, sekretariat, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `sekretariat` = '{0}', `notizen` = CONCAT_WS('\\n\\n', '{1}', notizen), `updated_visa` = '{2}', `updated_date` = STR_TO_DATE('{3}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{3}', '%d.%m.%Y %T') WHERE `id` = {4};\n".format(
        _escape_string(sekretariat),
        "{0}/import/{1}: Sekretariat geändert (PDF {2})".format(
            _date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query


def update_name_de_organisation(organisation_id, name_de, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `name_de` = {}, `notizen` = CONCAT_WS('\\n\\n', '{}', notizen), `updated_visa` = '{}', `updated_date` = STR_TO_DATE('{}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{}', '%d.%m.%Y %T') WHERE `id` = {};\n".format(
        _quote_str_or_NULL(_escape_string(name_de)),
        "{0}/import/{1}: Name DE geändert (PDF {2})".format(_date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query


def update_name_fr_organisation(organisation_id, name_fr, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `name_fr` = {}, `notizen` = CONCAT_WS('\\n\\n', '{}', notizen), `updated_visa` = '{}', `updated_date` = STR_TO_DATE('{}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{}', '%d.%m.%Y %T') WHERE `id` = {};\n".format(
        _quote_str_or_NULL(_escape_string(name_fr)),
        "{0}/import/{1}: Name FR geändert (PDF {2})".format(_date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query


def update_name_it_organisation(organisation_id, name_it, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `name_it` = {}, `notizen` = CONCAT_WS('\\n\\n', '{}', notizen), `updated_visa` = '{}', `updated_date` = STR_TO_DATE('{}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{}', '%d.%m.%Y %T') WHERE `id` = {};\n".format(
        _quote_str_or_NULL(_escape_string(name_it)),
        "{0}/import/{1}: Name IT geändert (PDF {2})".format(_date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query


def update_adresse_organisation(organisation_id, adresse_str, adresse_zusatz, adresse_plz, adresse_ort, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `adresse_strasse` = {0}, `adresse_zusatz` = {1}, `adresse_plz` = {2}, `ort` = {3}, `notizen` = CONCAT_WS('\\n\\n', '{4}', notizen), `updated_visa` = '{5}', `updated_date` = STR_TO_DATE('{6}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{6}', '%d.%m.%Y %T') WHERE `id` = {7};\n".format(
        _quote_str_or_NULL(_escape_string(adresse_str)),
        _quote_str_or_NULL(_escape_string(adresse_zusatz)),
        _quote_str_or_NULL(_escape_string(adresse_plz)),
        _quote_str_or_NULL(_escape_string(adresse_ort)),
        "{0}/import/{1}: Adresse geändert (PDF {2})".format(
            _date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query


def update_homepage_organisation(organisation_id, homepage, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `homepage` = {0}, `notizen` = CONCAT_WS('\\n\\n', '{1}', notizen), `updated_visa` = '{2}', `updated_date` = STR_TO_DATE('{3}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{3}', '%d.%m.%Y %T') WHERE `id` = {4};\n".format(
        _quote_str_or_NULL(_escape_string(homepage)),
        "{0}/import/{1}: Homepage geändert (PDF {2})".format(
            _date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query

def update_alias_organisation(organisation_id, alias, batch_time, pdf_date):
    query = "UPDATE `organisation` SET `alias_namen_de` = {0}, `notizen` = CONCAT_WS('\\n\\n', '{1}', notizen), `updated_visa` = '{2}', `updated_date` = STR_TO_DATE('{3}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{3}', '%d.%m.%Y %T') WHERE `id` = {4};\n".format(
        _quote_str_or_NULL(_escape_string(alias)),
        "{0}/import/{1}: Alias geändert (PDF {2})".format(
            _date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
        organisation_id
    )

    return query

def insert_interessenbindung_parlamentarische_gruppe(parlamentarier_id,
                                                     organisation_id, stichdatum, beschreibung, date, pdf_date):

    query = "INSERT INTO `interessenbindung` (`parlamentarier_id`, `organisation_id`, `art`, `funktion_im_gremium`, `beschreibung`,`deklarationstyp`, `status`, `behoerden_vertreter`, `von`, `created_visa`,`created_date`, `updated_visa`, `updated_by_import`, `notizen`, `eingabe_abgeschlossen_visa`, `eingabe_abgeschlossen_datum`, `freigabe_visa`, `freigabe_datum`) VALUES ({}, {}, '{}', '{}', '{}', '{}', '{}', '{}', STR_TO_DATE('{}', '%d.%m.%Y'), '{}',STR_TO_DATE('{}', '%d.%m.%Y %T'), '{}', STR_TO_DATE('{}', '%d.%m.%Y %T'), '{}', '{}', STR_TO_DATE('{}', '%d.%m.%Y %T'), '{}', STR_TO_DATE('{}', '%d.%m.%Y %T'));\n".format(
        parlamentarier_id,
        organisation_id,
        "vorstand",
        "praesident",
        beschreibung,
        "deklarationspflichtig",
        "deklariert",
        "N",
        _date_as_sql_string(stichdatum),
        "import",
        _datetime_as_sql_string(date),
        "import",
        _datetime_as_sql_string(date),
        "{0}/import/{1}: Erzeugt (PDF {2})".format(_date_as_sql_string(date), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(date),
        "import",
        _datetime_as_sql_string(date)
        )

    return query


def end_interessenbindung(interessenbindung_id, stichdatum, batch_time, pdf_date):
    query = "UPDATE `interessenbindung` SET `bis` = STR_TO_DATE('{0}', '%d.%m.%Y'), `notizen` = CONCAT_WS('\\n\\n', '{1}', notizen), `updated_visa` = '{2}', `updated_date` = STR_TO_DATE('{3}', '%d.%m.%Y %T'), `updated_by_import` = STR_TO_DATE('{3}', '%d.%m.%Y %T') WHERE `id` = {4};\n".format(
        _date_as_sql_string(stichdatum),
        "{0}/import/{1}: Bis-Datum gesetzt (PDF {2})".format(
            _date_as_sql_string(batch_time), user, _datetime_as_sql_string(pdf_date)),
        "import",
        _datetime_as_sql_string(batch_time),
       interessenbindung_id 
    )

    return query


# quote string variable with ' or if None return NULL
def _quote_str_or_NULL(str):
    return 'NULL' if str is None else "'" + str + "'"


# simple esape function for input strings
# real escaping not needed as we trust
# input from parlament.ch to not have SQL injection attacks
def _escape_string(string):
    if string is None:
        return None
    result = string.replace("'", "''").replace('\n', '\\n')
    return result


# the current date formatted as a string MySQL can understand
def _date_as_sql_string(date):
    return "{0:02d}.{1:02d}.{2}".format(date.day, date.month, date.year)


def _datetime_as_sql_string(date):
    return "{0:02d}.{1:02d}.{2} {3:02d}:{4:02d}:{5:02d}".format(date.day, date.month, date.year, date.hour, date.minute, date.second)
