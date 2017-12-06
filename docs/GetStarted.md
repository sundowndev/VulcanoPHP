# Getting started

## Step 1
~~~ bash
$ git clone https://github.com/SundownDEV/DaimyoCMS.git
$ composer install
~~~

## Step 2
#### edit the file ```app/config/config.ini```

~~~ ini
; main configuration file

[general]
site_name = "DaimyoCMS"
description = ""
tags = ""
thumbnail = ""

[framework]
path = "/"
URL = "http://www.example.com/"

; database config file

[dbDns]
host = "127.0.0.1"
dbname = "daimyocms"
user = "root"
pass = ""
charset = "utf8"

[paths]
...
~~~

## Step 3
#### Import the database ```app/config/database.sql```

~~~ mysql
mysql -u username -p database_name < database.sql
~~~

## Step 4
Allow DaiymoCMS to write in ```uploads``` folder
~~~ bash
$ chmod -R 777 content/uploads
~~~

## Step 5
#### Go to ```/admin``` and sign in with the default login:

~~~
login: admin
pass: sW5Yd1aPlmN
~~~

#### then go to ```settings``` and change the default password.

# Your CMS is now installed and ready!

You can now launch your localhost dev server
~~~
php -S localhost:8000 -t ./public
~~~

See the [admin documentation](https://github.com/SundownDEV/DaimyoCMS/blob/master/docs/AdminPanel.md) to get started with the dashboard.

# protips
#### If you're not using the default root path ```path = "/"``` then make sure to change it in the ```.htaccess```

~~~
# Set rewrite base here
ErrorDocument 403 /daimyo/404
~~~

This will prevent people getting 403 error instead of 404 when trying to access to a forbiden file.
