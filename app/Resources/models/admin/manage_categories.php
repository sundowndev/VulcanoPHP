<?php

if(!isset($_GET['p']) || $_GET['p'] == '1'){
    $from = 0;
    $to = $from + 10;
}else{
    $from = 0;
    $to = $from + 10;
}

$app->getDB()->query('SELECT * FROM d_category ORDER BY id DESC LIMIT '.$from.', '.$to);

$app->getDB()->execute();

$categories = $app->getDB()->resultset();

//foreach ($categories as $key => $category) {
//    $app->getDB()->query('SELECT id,username FROM d_users WHERE id = :id');
//    $app->getDB()->bind('id', $articles[$key]['author']);
//    $app->getDB()->execute();
//    $username = $app->getDB()->resultset();
//    $articles[$key]['author'] = $username[0]['username'];
//    
//    $app->getDB()->query('SELECT id,name FROM d_category WHERE id = :id');
//    $app->getDB()->bind('id', $articles[$key]['category_id']);
//    $app->getDB()->execute();
//    $category = $app->getDB()->resultset();
//    $articles[$key]['category'] = $category[0]['name'];
//}

$app->getTwig()->addGlobal('categories', $categories);