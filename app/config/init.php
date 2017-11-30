<?php

$app->getModule('Session\Session')->start();

function removeRegex($path)
{
    // find regex in the route path
    $regex = strstr($path, '(');
    
    // e.g: delete /([a-z0-9_-]+) from the path
    if(!empty($regex)){
        $path = str_replace('/'.$regex, '', $path);
    }
    
    return $path;
}

/* twig globals */
$path = $app->config['framework']['path'];

$app->getTwig()->addGlobal('site', array(
    'name' => $app->config['general']['site_name'],
    'description' => $app->config['general']['description'],
    'tags' => $app->config['general']['tags']
));

$app->getTwig()->addGlobal('paths', array(
    'root' => $path,
    'home' => $path.removeRegex($app->config['paths']['home']),
    'blog' => $path.removeRegex($app->config['paths']['blog']),
    'about' => $path.removeRegex($app->config['paths']['about']),
    'contact' => $path.removeRegex($app->config['paths']['contact']),
    'user' => $path.removeRegex($app->config['paths']['user']),
    'category' => $path.removeRegex($app->config['paths']['category']),
    'content' => $path.removeRegex($app->config['paths']['content']),
    'themes' => $path.removeRegex($app->config['paths']['themes']),
    'uploads' => $path.removeRegex($app->config['paths']['uploads']),
    'admin' => $path.removeRegex($app->config['paths']['admin'])
));

/* Adding admin twig views path */
$app->getTwigLoader()->addPath($app->views.'admin/', 'admin');

/* Setting up the private key for password hash */
$app->getModule('Secure\Secure')->setPrivateKey($app->config['framework']['private_key']);

/* init session auth value if it doesn't exist */
if(empty($app->getModule('Session\Session')->r('auth'))){
    $app->getModule('Session\Session')->w('auth', false);
/* if the user is connected, pass session data to twig */
}elseif($app->getModule('Session\Session')->r('auth') === true){
    $app->getTwig()->addGlobal('session', array(
        'auth' => $app->getModule('Session\Session')->r('auth'),
        'id' => $app->getModule('Session\Session')->r('id'),
        'username' => $app->getModule('Session\Session')->r('username'),
        'csrf' => $app->getModule('Session\Session')->r('csrf')
    ));
}

//$filterUsername = new Twig_SimpleFilter('getUsername', function ($int) {
//    return User::getUsername($int);
//});
//
//$twig->addFilter($filterUsername);

$app->get('/dev', function () use ($app) {
    /*
    $app->getDB()->query('SELECT * FROM d_articles');
    $app->getDB()->execute();

    $articles = $app->getDB()->resultset();

    var_dump($articles);
    */
});