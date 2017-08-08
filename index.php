<?php
	require __DIR__.'/app/system.php';

	require_once __DIR__.'/vendor/autoload.php';

	$app = new \App\Application($debug = true);

	require __DIR__.'/app/routes.php';

	$app->run();