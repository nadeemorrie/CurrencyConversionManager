# Currency Converter Manager

## Framework Used: Laravel (v5.4)

### Setup a local virtual dev machine

###Install Oracle Virtual Box (v5.1)
Download and install the DEB or DMG file: (https://www.virtualbox.org/wiki/Linux_Downloads).

##Install Vagrant (v1.9.1)
Download and install the DEB or DMG file: (https://www.vagrantup.com/downloads.html)

Create a "Code" directory in your home dirctory.

Clone the git repo into your "Code" directory.

Linux/Mac
$ git clone https://github.com/nadeemorrie/CurrencyConversionManager.git

Open the CurrencyConversionManager folder
$ cd CurrencyConversionManager/

Laravel utilizes Composer to manage its dependencies. So, before using Laravel, make sure you have Composer installed on your machine.

Run composer update
$ composer update

The repo/project ships with a Vagrantfile allowing you to run vagrant per project instead of globally.

Install vagrant virtual maching Homestead.
$ php vendor/bin/homestead make

The default virtual server runs on 192.168.10.10. see Homestead.yaml. you can change this ip to anything you like.

Add the ip in your hosts file. use any editor of your choice.
$ vi /etc/hosts

** Set it to something like this: 192.168.10.10 dev.currency

Finally, run vagrant from terminal
$ vagrant up

##Setup the database

## Ssh into the VM.
$ cd CurrencyConversionManager/
$ vagrant ssh

Once logged in via ssh
$ cd currencyconversionmanager

create the database
$ php artisan migrate

Populate database with data test data for the tables named currencies and actions.
$ php artisan db:seed

Finally, test the link:
http://dev.currency

## Mail configuration
Check the .env file, im using MAILGUN. You need to create a mailgun account and simply fill in the
Mail_Driver, Mailgun_Domain, Mailgun_Secret.
If you don't feel like setting up the mail config, that feature will be caught by an exception handler.



# Setup using your own custom server.

You will need to make sure your server meets the following requirements:

- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

You need composer.

## MySQL DB

The db script includes creationg of db and tables and population of data.

Browse to CurrencyConversionManager/App/Scripts/DB/currencyManager.sql

### DB Connection Settings
The DB settings can be configured in the .env file.



