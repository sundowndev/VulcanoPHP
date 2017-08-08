<?php

$app->before('GET|POST', '/.*', function() use ($app) {
	/* Configuration and twig globals */
	// $config = $app->getModule('JSON/Json')->getFile('config.json');
	$path = dirname($_SERVER['REDIRECT_URL']);

    $app->getTwig()->addGlobal('site', array(
    	'name' => "DaimyoCMS",
    	'description' => "Welcome to DaimyoCMS !",
    	'tags' => "daimyo,cms"
    ));

    $app->getTwig()->addGlobal('path', array(
		'home' => $path.'/',
		'blog' => $path.'/blog',
		'about' => $path.'/about',
		'contact' => $path.'/contact',
		/*...*/
		'user' => $path.'/user',
		'category' => $path.'/category',
		/*...*/
		'content' => $path.'/content',
		'themes' => $path.'/content/themes',
		'uploads' => $path.'/content/uploads'
	));

    /* Adding admin twig views path */
    $app->getTwigLoader()->addPath($app->views.'admin/', 'admin');
});

$app->get('/', function () use ($app) {
	$app->render(['src' => 'home', 'views' => 'home'], ['title' => 'Welcome']);
});

/* PHPINFO */
$app->get('/php', function () use ($app) {
	$path = dirname($_SERVER['REDIRECT_URL']);
	phpinfo();
});
/* PHPINFO */

$app->get('/search', function () use ($app) {
	$app->render(['src' => 'search', 'views' => 'search'], ['title' => 'Search']);
});

/* Blog page */
$app->get('/blog', function () use ($app) {
	$app->render(['src' => 'blog', 'views' => 'blog'], ['title' => 'Blog']);
});

/* About page */
$app->get('/about', function () use ($app) {
	$app->render(['views' => 'about'], ['title' => 'About']);
});

/* Single article */
$app->get('/article/([a-z0-9_-]+)', function () use ($app) {
	$app->render(['views' => 'single_article'], ['title' => '']);
});

/* Categories */
$app->get('/categories', function () use ($app) {
	$app->render(['views' => 'categories'], ['title' => 'Categories']);
});

/* Single category */
$app->get('/category/([a-z0-9_-]+)', function () use ($app) {
	$app->render(['views' => 'category'], ['title' => '']);
});

/* Single user */
$app->get('/user/([a-z0-9_-]+)', function () use ($app) {
	$app->render(['views' => 'single_user'], ['title' => '']);
});

/* Contact page */
$app->match('GET|POST','/contact', function () use ($app) {
	$app->render(['src' => 'contact','views' => 'contact'], ['title' => 'Me contacter']);
});

/* Including admin routes */
$app->mount('/admin', function () use ($app) {
	$app->router('admin'); // include admin routes
});

/* 404 error page */
$app->set404(function () use ($app) {
	$app->render(['views' => '404'], ['title' => 'Page not found']);
});