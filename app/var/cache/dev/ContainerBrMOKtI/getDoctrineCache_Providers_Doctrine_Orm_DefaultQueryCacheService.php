<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'doctrine_cache.providers.doctrine.orm.default_query_cache' shared service.

include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/Cache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/FlushableCache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/ClearableCache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiGetCache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiDeleteCache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiPutCache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/MultiOperationCache.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/CacheProvider.php';
include_once $this->targetDirs[4].'/vendor/doctrine/cache/lib/Doctrine/Common/Cache/ArrayCache.php';

$this->services['doctrine_cache.providers.doctrine.orm.default_query_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();

$instance->setNamespace('sf_orm_default_263ef550915cb74a9b664cab9105c94516f0432a92dc7d4a2f9ea62f03041519');

return $instance;
