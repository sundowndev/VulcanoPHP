<?php

echo $token;

if($app->getModule('Session\Session')->r('auth') === true){
    $app->getModule('Session\Session')->w('auth', false);
    $app->redirect('/');
} else {
    // not connected
}