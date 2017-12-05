<?php

if(!empty($args['id']) && !empty($args['token']) && $args['token'] === $app->getModule('Session\Session')->r('csrf')){
    $app->getDB()->query('DELETE FROM d_articles WHERE hash_id = :id');

    $app->getDB()->bind(':id', $args['id']);

    $app->getDB()->execute();
    
    $app->getModule('Session\Advert')->setAdvert('success', 'You deleted an article');
    
    $app->redirect($app->config['paths']['admin'].'/manage/articles');
}else{
    die('bad parameters or token');
}