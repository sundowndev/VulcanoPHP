<?php

$app->before('GET', '/.*', function() use ($app) {
    # This will be always executed
});

$app->get('/', function () use ($app) {
	$app->render(['views' => 'home'], ['title' => 'Welcome !', 'message' => 'mon site']);
});

$app->mount('/dev', function () use ($app) {
	$app->router('test'); // include test routes
});

$app->set404(function () use ($app) {
	$app->render(['views' => '404'], ['title' => 'Page not found']);
});