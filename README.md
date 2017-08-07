# DaimyoCMS
Open-source PHP CMS based on the micro framework [Daimyo](https://github.com/SundownDEV/Daimyo) ```version 0.0.1 dev```

## Requirement
- PHP 7+
- Git
- composer

## Installation

### Step 1
~~~
git clone https://github.com/SundownDEV/DaimyoCMS.git
composer install
~~~

### Step 2
Open the file ```/web/installation.php``` on your browser and enter database and admin user informations.

### Step 3
edit ```/app/config.json```
~~~
{
  "site_name":"Daimyo",
  "site_description":"my new cms based website",
  "tags":"my,new,website",
  "landing":"false",
  "debug":"true"
}
~~~

[...]
