<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'translation.loader.mo' shared service.

include_once $this->targetDirs[4].'/vendor/symfony/translation/Loader/LoaderInterface.php';
include_once $this->targetDirs[4].'/vendor/symfony/translation/Loader/ArrayLoader.php';
include_once $this->targetDirs[4].'/vendor/symfony/translation/Loader/FileLoader.php';
include_once $this->targetDirs[4].'/vendor/symfony/translation/Loader/MoFileLoader.php';

return $this->privates['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
