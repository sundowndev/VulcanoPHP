<?php

if($app->getModule('Session\Session')->r('auth') === false){
    $app->redirect($app->config['paths']['admin']);
}

var_dump($_SESSION);