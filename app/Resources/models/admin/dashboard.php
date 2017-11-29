<?php

if($app->getModule('Session\Session')->r('auth') === false){
    $app->redirect('/admin');
}

var_dump($_SESSION);