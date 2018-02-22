<?php

$app->getModule('Session\Session')->start();

function removeRegex ($path) {
    // find regex in the route path
    $regex = strstr($path, '(');
    
    // e.g: delete /([a-z0-9_-]+) from the path
    if(!empty($regex)){
        $path = str_replace('/' . $regex, '', $path);
    }
    
    return $path;
}

/* twig globals */
$app->getTwig()->addGlobal('site', [
    'name' => $app->config['general']['site_name'],
    'description' => $app->config['general']['description'],
    'tags' => $app->config['general']['tags']
]);

$app->getTwig()->addGlobal('paths', [
    'root' => $app->WEBROOT,
    'home' => removeRegex($app->config['paths']['home']),
    'blog' => removeRegex($app->config['paths']['blog']),
    'about' => removeRegex($app->config['paths']['about']),
    'contact' => removeRegex($app->config['paths']['contact']),
    'user' => removeRegex($app->config['paths']['user']),
    'category' => removeRegex($app->config['paths']['category']),
    'content' => removeRegex($app->config['paths']['content']),
    'themes' => removeRegex($app->config['paths']['themes']),
    'uploads' => removeRegex($app->config['paths']['uploads']),
    'admin' => removeRegex($app->config['paths']['admin'])
]);

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