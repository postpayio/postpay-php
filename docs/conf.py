import datetime

from pygments.lexers.web import PhpLexer
from sphinx.highlighting import lexers

lexers['php'] = PhpLexer(startinline=True, linenos=1)
lexers['php-annotations'] = PhpLexer(startinline=True, linenos=1)

project = 'Postpay SDK for PHP'
author = 'Postpay'

copyright = f'{datetime.datetime.today().year}, {author}'

version = '0.1.0'
release = version

extensions = [
]

templates_path = ['_templates']
source_suffix = '.rst'
master_doc = 'index'
language = 'en'

exclude_patterns = ['_build']
pygments_style = 'sphinx'
todo_include_todos = True


def setup(app):
    app.add_stylesheet('style.css')


html_theme = 'alabaster'

html_theme_options = {
    'logo': 'images/logo.png',
    'show_powered_by': False,
    'fixed_sidebar': True,
    'github_user': 'postpayio',
    'github_repo': 'postpay-php',
    'github_banner': True,
    'github_button': False,
    'github_type': 'star',
    'sidebar_list': '#8abbd5',
    'description': 'Postpay SDK for PHP',
}

html_favicon = 'favicon.ico'
html_static_path = ['_static']

html_sidebars = {
    '**': [
        'about.html',
        'navigation.html',
        'relations.html',
        'searchbox.html',
    ],
}

add_module_names = False
html_file_suffix = ''
html_show_sourcelink = False
html_show_sphinx = False
