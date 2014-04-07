newstocontentrelation
=====================

TYPO3 CMS extensions that converts the bodytext fields of news records (ext:news) to relations to tt_content.

Setup
-----

Install the extension with the extension manager. A new backend module will apear below admin tools.
If this does not happen, please reload the backend (e.g. by logout-login).

How does it work
----------------
It counts all records in tx_news_domain_model_news. For each news record, it adds a new tt_content relation
with the content from the bodytext field (the main content area of a news record).
Afterwards the content from bodytext is be removed.

Know problems
-------------
Access restrictions such as time based access and the deleted flag are currently honored while fetching the records.
Therefore it is not possible to convert those records with the current code.
A possible solution would be to reset the repository settings to include all records to fetch also deleted and
access restricted records.
