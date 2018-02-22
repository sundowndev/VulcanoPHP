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

$app->getTwig()->addGlobal('categories', $categories);