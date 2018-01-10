# Getting started

## Step 1
~~~ bash
$ git clone https://github.com/SundownDEV/DaimyoCMS.git
$ composer install
~~~

## Step 2
edit the file ```app/config/config.ini```

~~~ json
{
    "general": {
        "site_name": "daimyocms",
        "description": "blabla",
        "tags": "",
        "thumbnail": ""
    },
    "framework": {
        "URL": "http:\/\/localhost:8000",
        "path": "",
        "private_key": "8f096599520b9c46f10387aa6752a8f9d51ec23d5d9d6e6358a573a0154b4989"
    },
    "dbDns": {
        "host": "127.0.0.1",
        "dbname": "daimyocms",
        "user": "root",
        "pass": "",
        "charset": "utf8"
    },
    "paths": {
        ...
    }
}
~~~

## Step 3
Import the database ```app/config/database.sql```

~~~ mysql
mysql -u username -p database_name < database.sql
~~~

## Step 4
Allow DaiymoCMS to write in ```uploads``` folder
~~~ bash
$ chmod -R 777 content/uploads
~~~

## Step 5
Go to ```/admin``` and sign in with the default login:

~~~
login: admin
pass: sW5Yd1aPlmN
~~~

then go to ```settings``` and change the default password.

# Your CMS is now installed and ready!

You can now launch your localhost dev server
~~~
php -S localhost:8000 -t ./public
~~~

See the [admin documentation](/docs/AdminPanel.md) to get started with the dashboard.

## Protips

If you're not using the default root path ```path = "/"``` then make sure to change it in the ```.htaccess```
~~~
# Set rewrite base here
ErrorDocument 403 /daimyo/404
~~~
