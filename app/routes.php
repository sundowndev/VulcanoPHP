<?php

use App\Content\CategoryModel;

/*
 * Dev route
 * return the password hash of "test"
*/
/*$app->get('/install', function () use ($app) {
	echo $app->getModule('Secure\Secure')->hash_pass('test');
});*/

$app->setNamespace('\Controllers\HTTP');

/*
 * Including admin routes
 */
$app->mount( $app->config['paths']['admin'] , function () use ($app) {
    $app->router('admin'); // include admin routes
});

/* Home page */
$app->get( $app->config['paths']['home'] , 'MainController@HomeAction');

/* Search page */
$app->get( $app->config['paths']['search'] , 'MainController@SearchAction');

/* About page */
$app->get( $app->config['paths']['about'] , 'MainController@AboutAction');

/* Single article */
$app->get( $app->config['paths']['article'] , 'MainController@SingleArticleAction');

/* Categories */
$app->get( $app->config['paths']['categories'] , 'MainController@CategoriesAction');

/* Single category */
$app->get( $app->config['paths']['category'] , 'MainController@SingleCategoryAction');

/* Single user */
$app->get( $app->config['paths']['user'] , 'MainController@SingleUserAction');

/* Contact page */
$app->match('GET|POST', $app->config['paths']['contact'] , 'MainController@ContactAction');

/* 404 error page */
$app->set404('MainController@ErrorAction');
