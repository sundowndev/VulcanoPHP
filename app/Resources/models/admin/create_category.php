<?php

if(!empty($_POST['name'])){
    $app->getDB()->query('INSERT INTO d_category (name, slug, createdDate, description) VALUES(:name, :slug, NOW(), :description)');

    $app->getDB()->bind(':name', $_POST['name']);
    $app->getDB()->bind(':slug', 'classarticles');
    $app->getDB()->bind(':description', $_POST['description']);

    $app->getDB()->execute();
    
    $app->getModule('Session\Advert')->setAdvert('success', 'You successfully created your category!');
}