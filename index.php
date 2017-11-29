<?php
    session_start();

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__.'/app/system.php';

	require_once __DIR__.'/vendor/autoload.php';

	$app = new \App\Application($debug = true);

	require __DIR__.'/app/routes.php';

	$app->run();