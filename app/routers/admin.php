<?php

/* Login page */
$app->get('/', function () use ($app) {
	$app->render(['src' => 'admin/login', 'views' => '@admin/login'], ['title' => 'Login']);
});

$app->post('/', function () use ($app) {
	$app->render(['src' => 'admin/login', 'views' => '@admin/login'], ['title' => 'Login']);
});

/* Dashboard */
$app->get('/dashboard', function () use ($app) {
	$app->render(['views' => '@admin/dashboard'], ['title' => 'Dashboard']);
});