<p align="center">
  <img src="./docs/logo.png" alt="">
</p>

<p align="center">
  <a href="http://travis-ci.org/SundownDEV/DaimyoCMS"><img src="https://img.shields.io/travis/SundownDEV/DaimyoCMS.svg?style=flat" alt="Build Status"></a>
  <a href="#"><img src="http://img.shields.io/badge/source-SundownDEV/DaimyoCMS-brightgreen.svg?style=flat" alt="Source"></a>
  <a href="#"><img src="https://img.shields.io/badge/version-0.2.6-lightgrey.svg?style=flat" alt="Version"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat" alt="License"></a>
</p>

<p align="center"><strong>Deprecated in production : this project is not maintained anymore.</strong></p>

<p align="center">DaimyoCMS is an open-source Micro CMS based on the micro framework <a href="https://github.com/SundownDEV/Daimyo">Daimyo</a> using PHP 7.</p>

## Features
* Manage content such as users, articles and categories...
* Markdown editor
* Easy to customize
* Templating using Twig
* Lightweight and secure

## Why DaimyoCMS ?
You may ask why should you use this CMS while there's a lot of other popular ones, what makes this CMS better than another one ? Well, nothing. I created DaimyoCMS to handle tiny personal projects and code in my way as a junior developer. If you are looking for a minimal and micro php framework based CMS, you're on the right way. DaimyoCMS is just part of my personal R&D. Feel free to give it a review or contribute!

DaimyoCMS is fast, secure and lightweight, but also basic in features.

## Development
- [x] Templating
  - [x] Default blog template
  - [x] Default admin dashboard template
- [ ] Administration
  - [x] Admin login feature
  - [x] Manage articles
  - [x] Manage categories
  - [ ] Manage users
  - [ ] User role feature (Admin, Writer)
  - [x] Markdown editor
  - [ ] Image conversion & compression
  - [x] General configuration settings
  - [x] User settings
- [x] Blog
  - [x] Read articles
  - [x] Search feature
- [ ] Documentation
  - [x] Get started
  - [ ] Admin dashboard
  - [ ] Overview
  - [x] Routing
  - [x] Templating
  - [x] Exploited PDO class
  - [x] File upload
  - [ ] Data validation
- [ ] Unit tests

![screenshot dashboard](docs/screenshots/screen1.png)

![screenshot editor](docs/screenshots/screen2.png)

![screenshot editor2](docs/screenshots/screen3.png)

## Requirement
* PHP >= 7.1
  * php7.*-gd
* MySQL >= 5.7
* Composer

**You need to install (or enable in php.ini) PHP "file info" extension.**

# Documentation
* [Get started](docs/GetStarted.md)
* [Admin dashboard](docs/AdminPanel.md)

#### Developers
* [Overview](docs/Overview.md)
* [Routing](docs/Routing.md)
* [Templating](docs/Templating.md)
* [Exploited PDO Class](docs/PDOClass.md)
* [File upload](docs/UploadClass.md)
* [Validation](docs/ValidatorClass.md)
