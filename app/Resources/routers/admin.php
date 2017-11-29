<?php

require __DIR__.'/../controllers/Admin/Controller.php';

$app->setNamespace('\Controllers\Admin');

/* Login page */
$app->match('GET|POST','/', function () use ($app) {
	$app->render(['models' => 'admin/login', 'views' => '@admin/login'], ['title' => 'Login']);
});

/* Dashboard */
$app->get('/dashboard', function () use ($app) {
	$app->render(['models' => 'admin/dashboard', 'views' => '@admin/dashboard'], ['title' => 'Dashboard']);
});

/* Settings */
$app->get('/settings', function () use ($app) {
	$app->render(['views' => '@admin/settings'], ['title' => 'Settings']);
});

/* Logout */
$app->get('/logout/(\w+)', 'Controller@logoutAction');

/* Create content */
$app->mount('/create', function () use ($app) {
	/* Articles */
	$app->match('GET|POST','/article', function () use ($app) {
		$app->render(['models' => 'admin/create_article', 'views' => '@admin/create_article'], ['title' => 'Manage articles']);
	});

	/* Categories */
	$app->match('GET|POST','/category', function ($name) use ($app) {
		$app->render(['models' => 'admin/create_category', 'views' => '@admin/create_category'], ['title' => 'Edit a category', 'name' => $name]);
	});

	/* Users */
	$app->match('GET|POST','/user', function ($id) use ($app) {
		$app->render(['models' => 'admin/create_user', 'views' => '@admin/create_user'], ['title' => 'Create an user', 'id' => $id]);
	});

	/* Uploads */
	$app->match('GET|POST','/upload', function () use ($app) {
		$app->render(['models' => 'admin/create_upload', 'views' => '@admin/create_upload'], ['title' => 'Upload a file']);
	});
});

/* Manage content */
$app->mount('/manage', function () use ($app) {
	/* Articles */
	$app->get('/articles', function () use ($app) {
		$app->render(['models' => 'admin/manage_articles', 'views' => '@admin/manage_articles'], ['title' => 'Manage articles']);
	});

	$app->match('GET|POST','/article/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => 'admin/edit_article', 'views' => '@admin/edit_article'], ['title' => 'Edit an article', 'id' => $id]);
	});

	/* Categories */
	$app->get('/categories', function () use ($app) {
		$app->render(['models' => 'admin/manage_categories', 'views' => '@admin/manage_categories'], ['title' => 'Manage categories']);
	});

	$app->match('GET|POST','/category/([a-z0-9_-]+)', function ($name) use ($app) {
		$app->render(['models' => 'admin/edit_category', 'views' => '@admin/edit_category'], ['title' => 'Edit a category', 'name' => $name]);
	});

	/* Users */
	$app->get('/users', function () use ($app) {
		$app->render(['views' => '@admin/manage_users'], ['title' => 'Manage users']);
	});

	$app->match('GET|POST','/user/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => 'admin/edit_user', 'views' => '@admin/edit_user'], ['title' => 'Edit an user', 'id' => $id]);
	});

	/* Uploads */
	$app->get('/uploads', function () use ($app) {
		$app->render(['views' => 'admin/manage_uploads', 'views' => '@admin/manage_uploads'], ['title' => 'Manage uploads']);
	});
});

/* Delete content */
$app->mount('/delete', function () use ($app) {
	/* Articles */
	$app->get('/article/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => '@admin/delete_article'], ['id' => $id]);
	});

	/* Categories */
	$app->get('/category/([a-z0-9_-]+)', function ($name) use ($app) {
		$app->render(['models' => 'admin/delete_category'], ['name' => $name]);
	});

	/* Users */
	$app->get('/user/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => 'admin/delete_user'], ['id' => $id]);
	});

	/* Uploads */
	$app->get('/upload/([a-z0-9_-]+)', function ($id) use ($app) {
		$app->render(['models' => 'admin/delete_uploads'], ['id' => $id]);
	});
});