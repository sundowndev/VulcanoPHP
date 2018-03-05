# Templating

We use Twig for templating, a fast and secure template engine.

Templates are in `./resources/views` folder.

Twig instance is accessible from Application class

~~~php
$app = new \App\Application();

$twig = $app->getTwig();

$twig->render();
~~~

## Overview

Twig has a very concise syntax, which make templates more readable

~~~twig
{{ var }}
{{ var|escape }}
{{ var|e }}         {# shortcut to escape a variable #}
~~~

Twig has shortcuts for common patterns, like having a default text displayed when you iterate over an empty array

~~~twig
{% for user in users %}
    * {{ user.name }}
{% else %}
    No users have been found.
{% endfor %}
~~~

Twig supports everything you need to build powerful templates with ease: multiple inheritance, blocks, automatic output-escaping, and much more

~~~twig
{% extends "layout.html" %}

{% block content %}
    Content of the page...
{% endblock %}
~~~

## Official documentation
* [Introduction](https://github.com/twigphp/Twig/blob/2.x/doc/intro.rst)
* [Installation](https://github.com/twigphp/Twig/blob/2.x/doc/installation.rst)
* [templates](https://github.com/twigphp/Twig/blob/2.x/doc/templates.rst)
* [api](https://github.com/twigphp/Twig/blob/2.x/doc/api.rst)
* [advanced](https://github.com/twigphp/Twig/blob/2.x/doc/advanced.rst)
* [internals](https://github.com/twigphp/Twig/blob/2.x/doc/internals.rst)
* [recipes](https://github.com/twigphp/Twig/blob/2.x/doc/recipes.rst)
* [coding_standards](https://github.com/twigphp/Twig/blob/2.x/doc/coding_standards.rst)

[Complete documentation index](https://twig.symfony.com/doc/2.x/)