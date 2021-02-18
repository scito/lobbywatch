from requests import get
from bs4 import BeautifulSoup
import pandas as pd
from datetime import datetime


now = datetime.strftime(datetime.now(), '%y%m%d_%H%m')

root = 'http://www.public-affairs.ch'
member_url = 'http://www.public-affairs.ch/de/ueber-uns/mitglieder'


def souper(page_url):
    """beautifulsoup page reader"""
    user_agent = 'Mozilla/4.0 (compatible; MSIE 6.1; Windows XP)'
    headers = {'User-Agent': user_agent}
    page = get(page_url, headers=headers)
    soup = BeautifulSoup(page.content, 'html.parser') 
    return soup


def all_member_pages(url):
    """all pages that contains member info"""
    page_urls = [url]
    soup = souper(url)
    pagerbox = soup.find('ul', class_='pager')
    pages = pagerbox.findAll('li', class_='pager-item')
    for p in pages:
        url = p.find('a').get('href')
        url = root+url
        page_urls.append(url)
    return page_urls


def boxes(pages_list):
    """this gets all the basic info from the overview pages on the 'mitglieder' pages"""
    people = []
    for pagepath in pages_list:  
        soup = souper(pagepath)
        table = soup.find('table', class_='views-view-grid cols-4')
        td = table.findAll('td')
        for content in td:
            url = content.find('a').get('href')
            name = content.find('a').find('h2').text
            company = content.find('div', class_='views-field views-field-field-mitglied-unternehmen')
            company = company.find('div', class_='field-content').text
            fnctn = content.find('div', class_='views-field views-field-field-mitglied-funktion')
            fnctn = fnctn.find('div', class_='field-content').text
            person = {'url': url, 'name': name, 'company': company, 'function': fnctn}
            people.append(person)
    return people


def text_prepare(text):
    """this cleans te text from the memberpage"""
    filters = {'views': '',
               'field': '',
               'mitglied': '',
               'conditional': '',
               '-': ' ',
               '\n': ', ',
               ' [at] ': '@'}
    for fi in filters:
        text = text.replace(fi, filters[fi])
        text = text.strip()
    return text


def member_details(url):
    """this gets all the info from the memberpage if possible it gets the fieldname from the div-class"""
    soup = souper(url)
    block = soup.find('div', id="content", role="main")
    div = block.findAll('div', class_='views-field')
    result_dict = {}
    for d in div:
        fieldname = d.get('class')[1]
        fieldname = text_prepare(fieldname)
        text = text_prepare(d.text)
        try:
            split = text.split(': ')
            text = split[1]
            fieldname = split[0]
        except:
            pass
        result_dict[fieldname] = text
    return result_dict


memberpages = all_member_pages(member_url)
print(memberpages)
list_of_people = boxes(memberpages)
members = pd.DataFrame(list_of_people)
members = members[['name', 'company', 'function', 'url']]
print(members.head())


# create a list of urls to scrape
member_urls = members['url'].tolist()
member_url = member_url[:10]
# this scrapes all the details from every page and puts it in a dataframe for easy processing
r = []
for i in member_urls:
    r.append(member_details(root+i))
member_details = pd.DataFrame(r)
member_details.head(1)

# cleanup of column names
column_names = {'1': 'Position',
                '2': 'Address',
                '3': 'Zipcode_Place',
                '7': 'Email',
                '8': 'urls',
                '10': 'dept',
                '11': 'postfach'}
member_details.rename(columns=column_names, inplace=True)
member_details.dropna(axis=1, how='all')  # deletes empty columns

# save results a csv in same location as the script
member_details.to_csv(now + '_public-affairs-members.csv', sep=';')
print(member_details)
