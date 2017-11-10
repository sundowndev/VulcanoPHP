<?php
    $app->getDB()->query('SELECT * FROM d_articles ORDER BY id DESC LIMIT 0, 6');
    $app->getDB()->execute();

    $articles = $app->getDB()->resultset();

    $app->getTwig()->addGlobal('articles', $articles);
?>