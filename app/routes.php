<?php

$app->setNamespace('\Controllers\MainController');

/*
 * dev route
 * return the hash of "test"
*/
/*$app->get('/install', function () use ($app) {
	echo $app->getModule('Secure\Secure')->hash_pass('test');
});*/

$app->get( $app->config['paths']['home'] , 'Controller@HomeAction');

$app->get( $app->config['paths']['search'] , function () use ($app) {
	$app->render(['models' => 'search', 'views' => 'search'], ['title' => 'Search']);
});

/* Blog page */
$app->get( $app->config['paths']['blog'] , function () use ($app) {
	$app->render(['models' => 'blog', 'views' => 'blog/blog'], ['title' => 'Blog']);
});

/* About page */
$app->get( $app->config['paths']['about'] , 'Controller@AboutAction');

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
$app->set404('Controller@ErrorAction');