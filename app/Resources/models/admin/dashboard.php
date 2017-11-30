<?php

if($app->getModule('Session\Session')->r('auth') === false){
    $app->getModule('Session\Advert')->setAdvert('error', 'Connectez vous pour accèder à cette page');
    
    $app->redirect($app->config['paths']['admin']);
}