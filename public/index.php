<?php
    session_start();

	require __DIR__ . '/../app/system.php';

	require_once __DIR__.'/../vendor/autoload.php';

	$app = new \App\Application($debug = true);

    require_once __DIR__ . '/../app/config/init.php';

	require __DIR__.'/../app/routes.php';

	$app->run();