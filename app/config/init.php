<?php

/* twig globals */
$path = $app->config['framework']['path'];

$app->getTwig()->addGlobal('site', array(
    'name' => $app->config['general']['site_name'],
    'description' => $app->config['general']['description'],
    'tags' => $app->config['general']['tags']
));

$app->getTwig()->addGlobal('path', array(
    'root' => $path,
    'home' => $path.$app->config['paths']['home'],
    'blog' => $path.$app->config['paths']['blog'],
    'about' => $path.$app->config['paths']['about'],
    'contact' => $path.$app->config['paths']['contact'],
    'user' => $path.$app->config['paths']['user'],
    'category' => $path.$app->config['paths']['category'],
    'content' => $path.$app->config['paths']['content'],
    'themes' => $path.$app->config['paths']['themes'],
    'uploads' => $path.$app->config['paths']['uploads']
));

/* Adding admin twig views path */
$app->getTwigLoader()->addPath($app->views.'admin/', 'admin');

/* Setting up the private key for password hash */
$app->getModule('Secure\Secure')->setPrivateKey($app->config['framework']['private_key']);

if(empty($app->getModule('Session\Session')->r('auth'))){
    $app->getModule('Session\Session')->w('auth', false);
}

$app->get('/dev', function () use ($app) {
    /*
    $app->getDB()->query('SELECT * FROM d_articles');
    $app->getDB()->execute();

    $articles = $app->getDB()->resultset();

    var_dump($articles);
    */

    
    /*
    $test = $app->getModule('Secure\Secure')->hash_pass('test');
    $app->getModule('Secure\Secure')->verifyHash('test', $test);
    */
    /*echo $app->webroot;
    echo phpinfo();*/
});

?>