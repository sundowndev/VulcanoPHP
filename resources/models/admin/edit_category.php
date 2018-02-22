<?php

// category request
$app->getDB()->query('SELECT * FROM d_category WHERE hash_id = :id');

$app->getDB()->bind('id', $args['id']);

$app->getDB()->execute();
        
$category = $app->getDB()->single();

if(!$category){
    $app->redirect($app->config['paths']['admin'].'/404');
}

$app->getTwig()->addGlobal('category', $category);

if(isset($_POST['editCategory'])){
    if(!empty($_POST['name'])){
        $app->getDB()->query('UPDATE d_category SET name = :name, description = :desc WHERE hash_id = :hash_id');

        $app->getDB()->bind(':name', $_POST['name']);
        $app->getDB()->bind(':hash_id', $args['id']);
        $app->getDB()->bind(':desc', $_POST['description']);

        $app->getDB()->execute();

        $app->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your category!');
    }
    
    $app->getTwig()->addGlobal('POST', $_POST);
}