<?php

$app->before('GET|POST', '/.*', function() use ($app) {
    if($app->getModule('Session\Session')->r('auth') === false){
        $app->getModule('Session\Advert')->setAdvert('error', 'Connectez vous pour accèder à cette page');

        $url = $app->getURI();

        $app->redirect($app->config['paths']['admin'].'?redirect='.$url);
    }

    $app->set404('AdminController@AdminErrorAction');
});

$app->before('GET|POST', '/', function() use ($app) {
    if($app->getModule('Session\Session')->r('auth') === true){
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

    $app->get('/article/([\w+]+)', 'AdminController@EditArticleAction');
    $app->post('/article/([\w+]+)', 'AdminController@EditArticlePostAction');

    /*
     * Categories
     */
    $app->get('/categories', 'AdminController@ManageCategoriesAction');

    $app->get('/category/([\w+]+)', 'AdminController@EditCategoryAction');
    $app->post('/category/([\w+]+)', 'AdminController@EditCategoryPostAction');

    /*
     * Users
     */
    $app->get('/user', 'AdminController@ManageUsersAction');

    $app->get('/user/([\w+]+)', 'AdminController@EditUserAction');
    $app->post('/user/([\w+]+)', 'AdminController@EditUserPostAction');

    /*
     * Uploads
     */
    $app->get('/uploads', 'AdminController@ManageUploadsAction');

    $app->get('/upload/([\w+]+)', 'AdminController@EditUploadAction');
    $app->post('/upload/([\w+]+)', 'AdminController@EditUploadPostAction');
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

	/*
	 * Uploads
	 */
	$app->get('/upload', 'AdminController@CreateUploadAction');
	$app->post('/upload', 'AdminController@CreateUploadPostAction');
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
	$app->get('/category/([a-z0-9_-]+)/([\w+]+)', 'AdminController@DeleteCategoryAction');

	/*
	 * Users
	 */
	$app->get('/user/([\w+]+)/([\w+]+)', 'AdminController@DeleteUsersAction');

	/*
	 * Uploads
	 */
	$app->get('/upload/([\w+]+)/([\w+]+)', 'AdminController@DeleteUploadsAction');
});

/* Configuration */
$app->mount('/configuration', function () use ($app) {
	/*
	 * General
	 */
	$app->get('/', 'AdminController@ConfigurationAction');
	$app->post('/', 'AdminController@ConfigurationPostAction');

    /*
     * Appearance
     */
	$app->get('/appearance', 'AdminController@AppearanceAction');

    /*
     * Plugins
     */
	$app->get('/plugins', 'AdminController@PluginsAction');
});