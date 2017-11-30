<?php

if($app->getModule('Session\Session')->r('auth') === true){
    $app->getModule('Session\Session')->destroy();
    $app->redirect($app->config['paths']['admin']);
} else {
    // not connected
}