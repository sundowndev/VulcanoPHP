# DaimyoCMS
### ```version 0.1.6 dev|non-stable```
DaimyoCMS is an open-source PHP CMS based on the micro framework [Daimyo](https://github.com/SundownDEV/Daimyo) using PHP 7, markdown editor and bootstrap 4.

## Development

- [ ] Templating
  - [ ] Default blog template
  - [ ] Default admin dashboard template
- [ ] Administration
  - [ ] Admin login feature
  - [ ] Manage articles
      - [ ] Markdown editor
  - [ ] Manage categories
  - [ ] Manage local files
  - [ ] Manage users
    - [ ] User groups feature
  - [ ] General configuration settings
  - [ ] User settings
  - [ ] Plugin management
  - [ ] Templates management
  - [ ] Pages management
- [ ] Blog
  - [ ] Read articles
  - [ ] Comments
  - [ ] Sign up/in as simple user
  - [ ] Search feature

![screenshot dashboard](https://raw.githubusercontent.com/SundownDEV/DaimyoCMS/master/docs/screenshots/dashboard.jpg)

## Features
* Manage content such as users, articles and categories
* Local file management or with an external API
* Easy to customize, add pages, plugins, templates and more
* Make templating easily using Twig
* Lightweight and secure

## Why DaimyoCMS ?
You may ask why should you use this CMS while there's a lot of other popular ones, what makes this CMS better than another one ? Well, nothing. I created DaimyoCMS to handle tiny personal projects and code in my way as a junior developer. If you are looking for lightweight and micro php framework based content management system you're on the right way, DaimyoCMS is just part of my personal R&D. Feel free to give it a review or contribute!

## Requirement
* PHP 7.*
  * php7.*-gd
* MySQL 5.*
* Composer ~1.5.*

**You need to install (or enable in php.ini) PHP "file info" extension.**

# Documentations
* [Getting started](docs/GetStarted.md)
* [Administration panel](docs/AdminPanel.md)

#### Developers

* [Routing](docs/Routing.md)
* [Templating](docs/Templating.md)
* [Exploited PDO Class](docs/PDOClass.md)
* [File upload](docs/UploadClass.md)
