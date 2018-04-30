<p align="center">
  <img src="./docs/logo.png" alt="">
</p>

<p align="center">
  <a href="http://travis-ci.org/SundownDEV/Vulcano"><img src="https://img.shields.io/travis/SundownDEV/Vulcano.svg?style=flat" alt="Build Status"></a>
  <a href="#"><img src="http://img.shields.io/badge/source-SundownDEV/Vulcano-brightgreen.svg?style=flat" alt="Source"></a>
  <a href="#"><img src="https://img.shields.io/badge/version-0.1.6-red.svg?style=flat" alt="Version"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat" alt="License"></a>
</p>

<p align="center">An open-source security-first minimal CMS written with <a href="https://symfony.com/4">Symfony 4</a>.</p>

## The Why

Most of time a developer choose a framework or a CMS to build applications faster. Which is very useful because it provide you a lot of pre-installed tools and components. Also because it's popular, it provides you a large community and many plugins. The most popular framework is Symfony, but the most popular CMS is Wordpress. Wordpress has a really poor and slow framework which create a lot of performance and security issues. There's a lot of alts to Wordpress like Drupal, Voyager which are based on more recent frameworks such as Laravel or Symfony. The main problem of these CMSs is that they have a lot of features and components which can be usually unwanted. Also, these CMSs are very user-friendly and that might result in a security issue. When you have to create an application and want to start from a CMS, you probaly want to start on a good base but not with a lot of unwanted components or features. Also you probaly want the framework to be very flexible in time : add your own components, features, configuration and even a front framework. Symfony is a strong framework that provides you a lot of performance and security features and allows you to code really quickly. We want to use it at his best.

## The How

The main goal is to provide a minimal Content Management System that focus on security, performances, and flexibility in time. Vulcano is very simple : it is based on components so it's very simple to code features and it use a custom template management so you can manage your many assets and templates without change the structure of the framework and its configuration. There's also a security shield provided by Symfony that can be used for all your forms and sessions.

# Documentation
* [Get started](docs/GetStarted.md)
* [Security](docs/Security.md)

#### Developers
* [Framework overview](docs/Overview.md)
* [Routing](docs/Routing.md)
* [Templating](docs/Templating.md)
* [Validation](docs/Validator.md)

# Development
- [ ] Templating
  - [ ] Default blog template
  - [ ] Default admin dashboard template
- [ ] Administration
  - [ ] Manage articles
  - [ ] Manage categories
  - [ ] Manage users
  - [ ] General configuration settings
  - [ ] User settings
  - [ ] Template management
- [ ] Read articles
- [ ] Search feature
- [ ] Login feature
- [ ] User role feature (Admin, Writer, Member)
- [ ] Comments
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
