# Simple Codeigniter JSON API
Simple json API made whith Codeigniter


## Endpoints
+ /contacts/ - List all contacts
+ /contacts/get/{id} - Get contact
+ /contacts/add/{id} - Add contact (post request)
+ /contacts/edit/{id} - Update contact (post request)
+ /contacts/delete/{id} - Delete contact

Pots requests should have these fields
+ name (required)
+ email
+ telephone
+ address
+ facebook


## Instalation 
1. Import contacts table (contacts-table.sql) to your database
2. Drop files inside Codeigniter application folder
3. Done!


## Note
Deleted contacts remain in the database marked as inactive.
