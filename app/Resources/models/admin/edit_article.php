<?php

// article request
$app->getDB()->query('SELECT * FROM d_articles WHERE hash_id = :id');

$app->getDB()->bind(':id', $args['id']);

$app->getDB()->execute();
        
$article = $app->getDB()->single();

$app->getTwig()->addGlobal('article', $article);

// categories request
$app->getDB()->query('SELECT * FROM d_category');

$app->getDB()->execute();
        
$categories = $app->getDB()->resultset();

$app->getTwig()->addGlobal('categories', $categories);

if(isset($_POST['editArticle'])){
    if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['category'])){
        $app->getDB()->query('UPDATE d_articles SET title = :title, category_id = :cat, content = :content, editedDate = NOW() WHERE hash_id = :id');

        $app->getDB()->bind(':id', $args['id']);
        $app->getDB()->bind(':title', $_POST['title']);
        $app->getDB()->bind(':cat', $_POST['category']);
        $app->getDB()->bind(':content', $_POST['content']);

        $app->getDB()->execute();

        $app->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your article!');
    }
    
    $app->getTwig()->addGlobal('POST', $_POST);
}