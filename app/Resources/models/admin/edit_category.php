<?php

// category request
$app->getDB()->query('SELECT * FROM d_category WHERE name = :name');

$app->getDB()->bind('name', $args['name']);

$app->getDB()->execute();
        
$category = $app->getDB()->single();

if(!$category){
    $app->redirect($app->config['paths']['admin'].'/404');
}

$app->getTwig()->addGlobal('category', $category);

if(isset($_POST['editCategory'])){
    if(!empty($_POST['name']) && !empty($_POST['description'])){
        $app->getDB()->query('UPDATE d_category SET name = :newname, description = :desc WHERE name = :name');

        $app->getDB()->bind(':newname', $_POST['name']);
        $app->getDB()->bind(':name', $args['name']);
        $app->getDB()->bind(':desc', $_POST['description']);

        $app->getDB()->execute();

        $app->getModule('Session\Advert')->setAdvert('success', 'You successfully edited your category!');
    }
    
    $app->getTwig()->addGlobal('POST', $_POST);
}