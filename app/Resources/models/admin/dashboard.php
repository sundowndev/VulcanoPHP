<?php

if($app->getModule('Session\Session')->r('auth') === false){
    $app->redirect($app->config['paths']['admin']);
}