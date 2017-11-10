<?php
    $app->getDB()->query('SELECT * FROM d_articles');
    $app->getDB()->execute();

    $articles = $app->getDB()->resultset();

    //var_dump($articles);

    $app->getTwig()->addGlobal('articles', $articles);
?>