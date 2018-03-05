<?php

use App\Session\Auth;

$app->before('GET|POST', '/.*', function() use ($app) {
    if(!Auth::isLogged())
    {
        $app->getModule('Session\Advert')->setAdvert('error', 'Connectez vous pour accèder à cette page');

        $url = $app->getURI();

        $app->redirect($app->config['paths']['admin'].'?redirect='.$url);
    }

    $app->set404('AdminController@AdminErrorAction');
});

/*
 * Pass $_POST superglobal to twig everytime submitting a form
 */
$app->before('POST', '/.*', function() use ($app) {
    $app->getTwig()->addGlobal('POST', $_POST);
});

/*
 * If the user is logged, redirect him to dashboard
 */
$app->before('GET|POST', '/', function() use ($app) {
    if(Auth::isAdmin())
    {
        $app->redirect($app->config['paths']['admin'].'/dashboard');
    }
});

/* Login page */
$app->get('/', 'AdminController@LoginAction');
$app->post('/', 'AdminController@LoginPostAction');

/* Dashboard */
$app->get('/dashboard', 'AdminController@DashboardAction');

/* Settings */
$app->get('/settings', 'AdminController@SettingsAction');
$app->post('/settings/post/general', 'AdminController@SettingsGeneralPostAction');
$app->post('/settings/post/email', 'AdminController@SettingsEmailPostAction');
$app->post('/settings/post/password', 'AdminController@SettingsPasswordPostAction');

/* Logout */
$app->get('/logout/(\w+)', 'AdminController@logoutAction');

/* Manage content */
$app->mount('/manage', function () use ($app) {
    /*
     * Articles
     */
    $app->get('/articles', 'AdminController@ManageArticlesAction');

    $app->get('/article/([a-z0-9_-]+)', 'AdminController@EditArticleAction');
    $app->post('/article/([a-z0-9_-]+)', 'AdminController@EditArticlePostAction');

    /*
     * Categories
     */
    $app->get('/categories', 'AdminController@ManageCategoriesAction');

    $app->get('/category/([a-z0-9_-]+)', 'AdminController@EditCategoryAction');
    $app->post('/category/([a-z0-9_-]+)', 'AdminController@EditCategoryPostAction');

    /*
     * Users
     */
    $app->get('/users', 'AdminController@ManageUsersAction');

    $app->get('/user/([a-z0-9_-]+)', 'AdminController@EditUserAction');
    $app->post('/user/([a-z0-9_-]+)', 'AdminController@EditUserPostAction');
});

/* Create content */
$app->mount('/create', function () use ($app) {
	/*
	 * Articles
	 */
	$app->get('/article', 'AdminController@CreateArticleAction');
	$app->post('/article', 'AdminController@CreateArticlePostAction');

	/*
	 * Categories
	 */
	$app->get('/category', 'AdminController@CreateCategoryAction');
	$app->post('/category', 'AdminController@CreateCategoryPostAction');

	/*
	 * Users
	 */
	$app->get('/user', 'AdminController@CreateUserAction');
	$app->post('/user', 'AdminController@CreateUserPostAction');
});

/* Delete content */
$app->mount('/delete', function () use ($app) {
	/*
	 * Articles
	 */
	$app->get('/article/([\w+]+)/([\w+]+)', 'AdminController@DeleteArticleAction');

	/*
	 * Categories
	 */
	$app->get('/category/([\w+]+)/([\w+]+)', 'AdminController@DeleteCategoryAction');

	/*
	 * Users
	 */
	$app->get('/user/([\w+]+)/([\w+]+)', 'AdminController@DeleteUsersAction');
});

/* Configuration */
$app->mount('/configuration', function () use ($app) {
	/*
	 * General
	 */
	$app->get('/', 'AdminController@ConfigurationAction');
	$app->post('/', 'AdminController@ConfigurationPostAction');
});