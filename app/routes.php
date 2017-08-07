<?php

$app->before('GET', '/.*', function() use ($app) {
	/* Configuration and twig globals */

	//$config = $app->getModule('JSON/Json')->getFile('config.json');

    $app->getTwig()->addGlobal('site', array(
    	'name' => "Daimyo",
    	'description' => "abc",
    	'tags' => "abc"
    ));

    $app->getTwig()->addGlobal('path', array(
		'home' => '/',
		'articles' => '/news',
		'contact' => '/contact',
		/*...*/
		'assets' => '/assets',
		'images' => '/assets/images'
	));

    /* Adding admin twig views path */
    $app->getTwigLoader()->addPath($app->views.'admin/', 'admin');
});

$app->get('/', function () use ($app) {
	$app->render(['views' => 'home'], ['title' => 'Welcome']);
});

$app->get('/search', function () use ($app) {
	$app->render(['src' => 'search', 'views' => 'search'], ['title' => 'Search']);
});

/* Articles list */
$app->get('/news', function () use ($app) {
	$app->render(['views' => 'news'], ['title' => 'News']);
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
$app->get('/contact', function () use ($app) {
	$app->render(['src' => 'contact','views' => 'contact'], ['title' => 'Me contacter']);
});

$app->post('/contact', function () use ($app) {
	$app->render(['src' => 'contact','views' => 'contact'], ['title' => 'Me contacter']);
});

/* Including admin routes */
$app->mount('/admin', function () use ($app) {
	$app->router('admin'); // include admin routes
});

$app->set404(function () use ($app) {
	$app->render(['views' => '404'], ['title' => 'Page not found']);
});