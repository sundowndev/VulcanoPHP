# Getting started

## Step 1
~~~ bash
$ git clone https://github.com/SundownDEV/DaimyoCMS.git
$ cd DaimyoCMS
$ composer install
~~~

## Step 2
Create and edit the file ```app/config/config.json```

~~~ json
{
    "general": {
        "name": "DaimyoCMS",
        "description": "CMS based on the micro PHP framework Daimyo.",
        "tags": "daimyo, cms, php",
        "thumbnail": ""
    },
    "dbDns": {
        "host": "localhost",
        "dbname": "daimyocms",
        "user": "root",
        "pass": "",
        "charset": "utf8"
    }
}

~~~

## Step 3

Create the database manually

~~~
mysql -u root -p
CREATE DATABASE daimyocms;
~~~

Edit the make file with your database name and password if you want to (not recommended).

~~~
dev:
	php -S localhost:8000 -t ./public;

migration-run:
	mysql -u root -p < migrations/0-init.sql;
	mysql -u root -p daimyocms < migrations/1-tables.sql;

migration-commit:
	mysqldump -u root -p -h 127.0.0.1 daimyocms > migrations/1-tables.sql;
~~~

Import the database

~~~ mysql
make migration-run
~~~

## Step 4
Allow DaiymoCMS to write in ```uploads``` folder
~~~ bash
$ find ./content -type f -exec chmod 644 {} \;
$ find ./content -type d -exec chmod 755 {} \;
~~~

# DaimyoCMS is now installed and ready!

You can test it on your dev server
~~~
make dev
~~~

Go to ```localhost:8000/manager``` and sign in with the default login:

~~~
login: admin
pass: d41my0
~~~

then go to ```/manager/settings``` and change the default password.

Check the [admin documentation](/docs/AdminPanel.md) to get started with the dashboard.
