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
#### Setup the database ```app/config/database.sql``` from PhpMyAdmin

## Step 4
Allow DaiymoCMS to write in ```uploads``` folder
~~~ bash
$ chmod -R 777 public/uploads
~~~