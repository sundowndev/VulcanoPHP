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
    $articles[$key]['author'] = $articles[$key]['author'];
}

$app->getTwig()->addGlobal('articles', $articles);