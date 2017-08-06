<?php

$app->get('/', function () use ($app) {
	echo "/dev home";
});

$app->get('/test', function () use ($app) {
	echo "/dev/test page";
});