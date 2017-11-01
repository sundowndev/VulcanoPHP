<?php

$app->before('GET|POST', '/.*', function() use ($app) {
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
    
    //$app->getModule('Secure\Secure')->testEmptyString();
});

$app->get( $app->config['paths']['home'] , function () use ($app) {
	$app->render(['models' => 'home', 'views' => 'home/home'], ['title' => 'Welcome']);
});

$app->get( $app->config['paths']['search'] , function () use ($app) {
	$app->render(['models' => 'search', 'views' => 'search'], ['title' => 'Search']);
});

/* Blog page */
$app->get( $app->config['paths']['blog'] , function () use ($app) {
	$app->render(['models' => 'blog', 'views' => 'blog/blog'], ['title' => 'Blog']);
});

/* About page */
$app->get( $app->config['paths']['about'] , function () use ($app) {
	$app->render(['views' => 'about/about'], ['title' => 'About']);
});

/* Single article */
$app->get( $app->config['paths']['article'] , function () use ($app) {
	$app->render(['views' => 'articles/single_article'], ['title' => '']);
});

/* Categories */
$app->get( $app->config['paths']['categories'] , function () use ($app) {
	$app->render(['views' => 'categories/categories'], ['title' => 'Categories']);
});

/* Single category */
$app->get( $app->config['paths']['category'] , function () use ($app) {
	$app->render(['views' => 'categories/single_category'], ['title' => '']);
});

/* Single user */
$app->get( $app->config['paths']['user'] , function () use ($app) {
	$app->render(['views' => 'users/single_user'], ['title' => '']);
});

/* Contact page */
$app->match('GET|POST', $app->config['paths']['contact'] , function () use ($app) {
	$app->render(['models' => 'contact','views' => 'contact/contact'], ['title' => 'Me contacter']);
});

/* Including admin routes */
$app->mount( $app->config['paths']['admin'] , function () use ($app) {
	$app->router('admin'); // include admin routes
});

/* 404 error page */
$app->set404(function () use ($app) {
	$app->render(['views' => '404/404'], ['title' => 'Page not found']);
});