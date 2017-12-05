<?php

if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
    $app->getDB()->query('INSERT INTO d_articles (hash_id, title, author, category_id, publishDate, content) VALUES(:hash_id, :title, :author, :category_id, NOW(), :content)');

    $app->getDB()->bind(':hash_id', md5(uniqid()));
    $app->getDB()->bind(':title', $_POST['title']);
    $app->getDB()->bind(':author', $app->getModule('Session\Session')->r('id'));
    $app->getDB()->bind(':category_id', $_POST['category']);
    $app->getDB()->bind(':content', $_POST['content']);

    $app->getDB()->execute();
    
    $app->getModule('Session\Advert')->setAdvert('success', 'You successfully published your article!');
}

$app->getDB()->query('SELECT * FROM d_category ORDER BY id DESC');
$app->getDB()->execute();
$categories = $app->getDB()->resultset();

$app->getTwig()->addGlobal('categories', $categories);