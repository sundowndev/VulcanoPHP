<?php

$app->getModule('Session\Session')->start();

/* Adding admin twig views path */
$app->getTwigLoader()->addPath($app->DIR_VIEWS.'admin/', 'admin');

/*
 * Setting password hash options
 */
$options = [
    'cost' => 12 // the default cost is 10
];

$app->getModule('Secure\Secure')->setOptions($options);

/* init session auth value if it doesn't exist */
if(empty($app->getModule('Session\Session')->r('auth'))){
    $app->getModule('Session\Session')->w('auth', false);
/* if the user is connected, pass session data to twig */
}elseif($app->getModule('Session\Session')->r('auth') === true){
    $app->getTwig()->addGlobal('session', array(
        'auth' => $app->getModule('Session\Session')->r('auth'),
        'id' => $app->getModule('Session\Session')->r('id'),
        'hash_id' => $app->getModule('Session\Session')->r('hash_id'),
        'username' => $app->getModule('Session\Session')->r('username'),
        'email' => $app->getModule('Session\Session')->r('email'),
        'csrf' => $app->getModule('Session\Session')->r('csrf')
    ));
}