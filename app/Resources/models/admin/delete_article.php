<?php

use \Controllers\Admin\Controller;

if(!empty($args['id']) && !empty($args['token']) && $args['token'] === $app->getModule('Session\Session')->r('csrf')){
    $app->getDB()->query('DELETE FROM d_articles WHERE hash_id = :id');

    $app->getDB()->bind(':id', $args['id']);

    $app->getDB()->execute();
    
    $controller = new Controller();
    $controller->deleteUpload($args['id'].'.jpg');
    
    unlink($app->webroot.$app->config['paths']['uploads'].'/'.$args['id'].'.jpg');
    
    $app->getModule('Session\Advert')->setAdvert('success', 'You deleted an article');
    
    $app->redirect($app->config['paths']['admin'].'/manage/articles');
}else{
    die('bad parameter or token');
}