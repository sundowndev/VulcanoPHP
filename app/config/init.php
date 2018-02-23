<?php

$app->getModule('Session\Session')->start();

/*
 * Setting password hash options
 */
$options = [
    'cost' => 12 // the default cost is 10
];

$app->getModule('Secure\Secure')->setOptions($options);