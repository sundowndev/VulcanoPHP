<?php

if(!empty($args['id']) && !empty($args['token']) && $args['token'] === $app->getModule('Session\Session')->r('csrf')){
    $app->getDB()->query('DELETE FROM d_category WHERE hash_id = :id');

    $app->getDB()->bind(':id', $args['id']);

    $app->getDB()->execute();
    
    $app->getModule('Session\Advert')->setAdvert('success', 'You successfully deleted a category');
    
    $app->redirect($app->config['paths']['admin'].'/manage/categories');
}else{
    die('bad parameter or token');
}