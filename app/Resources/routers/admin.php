<?php

$app->setNamespace('\Controllers\Admin');

$app->before('GET|POST|PUT|DELETE|OPTIONS|PATCH|HEAD', '/.*', function() use ($app) {
    if($app->getModule('Session\Session')->r('auth') === false){
        $app->getModule('Session\Advert')->setAdvert('error', 'Connectez vous pour accèder à cette page');

        $app->redirect($app->config['paths']['admin']);
    }
    
    $app->set404(function () use ($app) {
        $app->render(['views' => '@admin/404'], ['title' => 'Page not found']);
    });
});

$app->before('GET|POST', '/', function() use ($app) {
    if($app->getModule('Session\Session')->r('auth') === true){
        $app->redirect($app->config['paths']['admin'].'/dashboard');
    }
});

/* Login page */
$app->match('GET|POST', '/', function () use ($app) {
	$app->render(['models' => 'admin/login', 'views' => '@admin/login'], ['title' => 'Login', 'page' => 'login']);
});

/* Dashboard */
$app->get('/dashboard', function () use ($app) {
	$app->render(['models' => 'admin/dashboard', 'views' => '@admin/dashboard'], ['title' => 'Dashboard', 'page' => 'dashboard']);
});

/* Settings */
$app->match('GET|POST', '/settings', function () use ($app) {
	$app->render(['models' => 'admin/settings', 'views' => '@admin/settings'], ['title' => 'Mes paramètres', 'page' => 'settings']);
});

/* Logout */
$app->get('/logout/(\w+)', 'Controller@logoutAction');

/* Create content */
$app->mount('/create', function () use ($app) {
	/* Articles */
	$app->match('GET|POST','/article', function () use ($app) {
		$app->render(['models' => 'admin/create_article', 'views' => '@admin/create_article'], ['title' => 'Create an article', 'page' => 'articles']);
	});

	/* Categories */
	$app->match('GET|POST','/category', function () use ($app) {
		$app->render(['models' => 'admin/create_category', 'views' => '@admin/create_category'], ['title' => 'Create a category', 'page' => 'categories']);
	});

	/* Users */
	$app->match('GET|POST','/user', function () use ($app) {
		$app->render(['models' => 'admin/create_user', 'views' => '@admin/create_user'], ['title' => 'Create an user', 'page' => 'users']);
	});

	/* Uploads */
	$app->match('GET|POST','/upload', function () use ($app) {
		$app->render(['models' => 'admin/create_upload', 'views' => '@admin/create_upload'], ['title' => 'Upload a file', 'page' => 'uploads']);
	});
});

/* Manage content */
$app->mount('/manage', function () use ($app) {
	/* Articles */
	$app->get('/articles', function () use ($app) {
		$app->render(['models' => 'admin/manage_articles', 'views' => '@admin/manage_articles'], ['title' => 'Manage articles', 'page' => 'articles']);
	});

	$app->match('GET|POST','/article/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => 'admin/edit_article', 'views' => '@admin/edit_article'], ['title' => 'Edit an article', 'id' => $id, 'page' => 'articles']);
	});

	/* Categories */
	$app->get('/categories', function () use ($app) {
		$app->render(['models' => 'admin/manage_categories', 'views' => '@admin/manage_categories'], ['title' => 'Manage categories', 'page' => 'categories']);
	});

	$app->match('GET|POST','/category/([a-z0-9_-]+)', function ($name) use ($app) {
		$app->render(['models' => 'admin/edit_category', 'views' => '@admin/edit_category'], ['title' => 'Edit a category', 'name' => $name, 'page' => 'categories']);
	});

	/* Users */
	$app->get('/users', function () use ($app) {
		$app->render(['views' => '@admin/manage_users'], ['title' => 'Manage users', 'page' => 'users']);
	});

	$app->match('GET|POST','/user/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => 'admin/edit_user', 'views' => '@admin/edit_user'], ['title' => 'Edit an user', 'id' => $id, 'page' => 'users']);
	});

	/* Uploads */
	$app->get('/uploads', function () use ($app) {
		$app->render(['views' => 'admin/manage_uploads', 'views' => '@admin/manage_uploads'], ['title' => 'Manage uploads', 'page' => 'uploads']);
	});
});

/* Delete content */
$app->mount('/delete', function () use ($app) {
	/* Articles */
	$app->get('/article/([a-z0-9_-]+)/([a-z0-9_-]+)', function ($id,$token) use ($app) {
		$app->render(['models' => 'admin/delete_article'], ['id' => $id, 'token' => $token, 'page' => 'delete']);
	});

	/* Categories */
	$app->get('/category/([a-z0-9_-]+)/([a-z0-9_-]+)', function ($name,$token) use ($app) {
		$app->render(['models' => 'admin/delete_category'], ['name' => $name, 'token' => $token, 'page' => 'categories']);
	});

	/* Users */
	$app->get('/user/([a-z0-9_-]+)/([a-z0-9_-]+)', function ($id,$token) use ($app) {
		$app->render(['models' => 'admin/delete_user'], ['id' => $id, 'token' => $token, 'page' => 'users']);
	});

	/* Uploads */
	$app->get('/upload/([a-z0-9_-]+)/([a-z0-9_-]+)', function ($id,$token) use ($app) {
		$app->render(['models' => 'admin/delete_uploads'], ['id' => $id, 'token' => $token, 'page' => 'uploads']);
	});
});

/* Configuration */
$app->mount('/configuration', function () use ($app) {
	/* General */
	$app->match('GET|POST', '/', function () use ($app) {
		$app->render(['models' => 'admin/configuration', 'views' => 'admin/configuration'], ['title' => 'Configuration', 'page' => 'configuration']);
	});
    
    /* Appearance */
	$app->get('/appearance', function () use ($app) {
		$app->render(['models' => 'admin/appearance', 'views' => 'admin/appearance'], ['title' => 'Appearance', 'page' => 'configuration']);
	});
    
    /* Plugins */
	$app->get('/plugins', function () use ($app) {
		$app->render(['models' => 'admin/plugins', 'views' => 'admin/plugins'], ['title' => 'Plugins', 'page' => 'configuration']);
	});
});