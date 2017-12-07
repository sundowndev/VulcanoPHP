<?php

if(!isset($_GET['p']) || $_GET['p'] == '1'){
    $from = 0;
    $to = $from + 10;
}else{
    $from = 0;
    $to = $from + 10;
}

$app->getDB()->query('SELECT * FROM d_articles ORDER BY id DESC LIMIT '.$from.', '.$to);

$app->getDB()->execute();
$articles = $app->getDB()->resultset();

foreach ($articles as $key => $article) {
    $app->getDB()->query('SELECT id,username FROM d_users WHERE id = :id');
    $app->getDB()->bind('id', $articles[$key]['author']);
    $app->getDB()->execute();
    $username = $app->getDB()->resultset();
    $articles[$key]['author'] = $username[0]['username'];
    
    $app->getDB()->query('SELECT id,name FROM d_category WHERE id = :id');
    $app->getDB()->bind('id', $articles[$key]['category_id']);
    $app->getDB()->execute();
    $category = $app->getDB()->resultset();
    $articles[$key]['category'] = $category[0]['name'];
}

$app->getTwig()->addGlobal('articles', $articles);