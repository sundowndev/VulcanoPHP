<p align="center">
  <img src="./docs/logo.png" alt="">
</p>

<p align="center">
  <a href="http://travis-ci.org/SundownDEV/DaimyoCMS"><img src="https://img.shields.io/travis/SundownDEV/DaimyoCMS.svg?style=flat" alt="Build Status"></a>
  <a href="#"><img src="http://img.shields.io/badge/source-SundownDEV/DaimyoCMS-brightgreen.svg?style=flat" alt="Source"></a>
  <a href="#"><img src="https://img.shields.io/badge/version-1.0.0-brightgreen.svg?style=flat" alt="Version"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat" alt="License"></a>
</p>

<p align="center">An open-source security oriented minimal PHP CMS written with <a href="https://symfony.com/4">Symfony 4</a>.</p>

## Features
* Manage content such as users, articles, categories and more.
* Lightweight and Security-first framework
* Developer friendly

## The Why

Most of time a developer choose a framework or a CMS to build applications faster. Which is very useful because it provide you a lot of pre-installed tools and components. The most popular is Symfony, but the most popular CMS is Wordpress, which is a problem. Wordpress has a really poor and slow framework which create a lot performance and security issue. There's a lot of alts to Wordpress like Drupal, Voyager which are based on more recent frameworks such as Laravel or Symfony. The main problem of these CMSs is that they have a lot of features and components which can be usually unwanted. Also, these CMSs are very user-friendly and that might result in a security issue. When you have to create an application and want to start from a CMS, you probaly want to start on a good base but not with a lot of unwanted components or features. Also you probaly want the framework to be very flexible in time : add your own components, features, configuration and even a front framework.

## The How

The main goals of DaimyoCMS is to provide a minimal CMS that focus on security, performances, and flexibility in time.

# Documentation
* [Get started](docs/GetStarted.md)
* [Security](docs/Security.md)

#### Developers
* [Framework overview](docs/Overview.md)
* [Routing](docs/Routing.md)
* [Templating](docs/Templating.md)
* [Validation](docs/Validator.md)

## Development
- [ ] Templating
  - [ ] Default blog template
  - [ ] Default admin dashboard template
- [ ] Administration
  - [ ] Admin login feature
  - [ ] Manage articles
  - [ ] Manage categories
  - [ ] Manage users
  - [ ] User role feature (Admin, Writer, Member)
  - [ ] WYSIWYG editor
  - [ ] General configuration settings
  - [ ] User settings
  - [ ] Template management
- [ ] Blog
  - [ ] Read articles
  - [ ] Search feature
- [ ] Documentation
  - [ ] Get started
  - [ ] Framework overview
  - [ ] Security
  - [ ] Routing
  - [ ] Templating
  - [ ] Data validation
- [ ] Unit tests

## Requirements
* PHP >= 7.1
  * php7.*-gd
* MySQL >= 5.7
* Composer

**You need to install (or enable in php.ini) PHP "file info" extension.**
