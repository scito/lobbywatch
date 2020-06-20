import re
import unicodedata as ud


def clean_whitespace(str):
    if str == None: return None
    return re.sub(r'\s+', ' ', str).strip()

def escape_SQL(str):
    return _escape_string(str)

# quote string variable with ' or if None return NULL
def _quote_str_or_NULL(str):
    return 'NULL' if str is None else "'" + str + "'"


# simple esape function for input strings
def _escape_string(string):
    if string is None: return None
    result = string.replace("'", "''").replace('\n', '\\n').replace('\\', '\\\\')
    return result


# the current date formatted as a string MySQL can understand
def _date_as_sql_string(date):
    return "{0:02d}.{1:02d}.{2}".format(date.day, date.month, date.year)


def _datetime_as_sql_string(date):
    return "{0:02d}.{1:02d}.{2} {3:02d}:{4:02d}:{5:02d}".format(date.day, date.month, date.year, date.hour, date.minute, date.second)

def clean_str(str):
    if str == None: return None
    return re.sub(r'<[^<]+?>', '', re.sub(r'[«»“”„]', '"', re.sub(r"[–—]", "-", re.sub(r"[`‘’‚]", "'", ud.normalize('NFC', str))))).strip()

def replace_bullets(str):
    if str == None: return None
    return re.sub(r'^(-\s|•\s|)', '* ', str.strip()) if str.count('- ') <= 1 or str.count('- und ') > 0 else str.strip()
