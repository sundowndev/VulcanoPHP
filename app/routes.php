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

$app->get( $app->config['paths']['search'] , 'Controller@SearchAction');

/* Blog page */
$app->get( $app->config['paths']['blog'] , 'Controller@BlogAction');

/* About page */
$app->get( $app->config['paths']['about'] , 'Controller@AboutAction');

/* Single article */
$app->get( $app->config['paths']['article'] , 'Controller@SingleArticleAction');

/* Categories */
$app->get( $app->config['paths']['categories'] , 'Controller@CategoriesAction');

/* Single category */
$app->get( $app->config['paths']['category'] , 'Controller@SingleCategoryAction');

/* Single user */
$app->get( $app->config['paths']['user'] , 'Controller@SingleUserAction');

/* Contact page */
$app->match('GET|POST', $app->config['paths']['contact'] , 'Controller@ContactAction');

/* Including admin routes */
$app->mount( $app->config['paths']['admin'] , function () use ($app) {
	$app->router('admin'); // include admin routes
});

/* 404 error page */
$app->set404('Controller@ErrorAction');