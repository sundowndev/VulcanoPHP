<p align="center">
  <img src="./docs/logo.png" alt="">
</p>

<p align="center">
  <a href="http://travis-ci.org/SundownDEV/DaimyoCMS"><img src="https://img.shields.io/travis/SundownDEV/DaimyoCMS.svg?style=flat" alt="Build Status"></a>
  <a href="#"><img src="http://img.shields.io/badge/source-SundownDEV/DaimyoCMS-brightgreen.svg?style=flat" alt="Source"></a>
  <a href="#"><img src="https://img.shields.io/badge/version-1.0.0-brightgreen.svg?style=flat" alt="Version"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat" alt="License"></a>
</p>

<p align="center">DaimyoCMS is an open-source Micro CMS written with <a href="https://symfony.com/4">Symfony 4</a> and Webpack-encore.</p>

## Features
* Manage content such as users, articles, categories and more.
* WYSIWYG editor
* Easy to customize
* Create custom templates using Twig
* Lightweight and secure

## Why DaimyoCMS ?
You may ask why should you use this CMS while there's a lot of other popular ones, what makes this CMS better than another one ? Well, nothing. I created DaimyoCMS to handle tiny personal projects and code in my way as a junior developer. If you are looking for a minimal, secure and Symfony based CMS, you're on the right way. DaimyoCMS is just part of my personal R&D. Feel free to give it a review or contribute!

DaimyoCMS is fast, secure and lightweight. But also basic in features.

## Development
- [] Templating
  - [] Default blog template
  - [] Default admin dashboard template
- [] Administration
  - [] Admin login feature
  - [] Manage articles
  - [] Manage categories
  - [] Manage users
  - [] User role feature (Admin, Writer, Member)
  - [] WYSIWYG editor
  - [] General configuration settings
  - [] User settings
  - [] Template management
- [] Blog
  - [] Read articles
  - [] Search feature
- [] Documentation
  - [] Get started
  - [] Framework overview
  - [] Security
  - [] Routing
  - [] Templating
  - [] Data validation
- [] Unit tests

# Documentation
* [Get started](docs/GetStarted.md)
* [Security](docs/Security.md)

#### Developers
* [Framework overview](docs/Overview.md)
* [Routing](docs/Routing.md)
* [Templating](docs/Templating.md)
* [Validation](docs/Validator.md)

## Requirement
* PHP >= 7.1
  * php7.*-gd
* MySQL >= 5.7
* Composer

**You need to install (or enable in php.ini) PHP "file info" extension.**