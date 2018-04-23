<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'validator.mapping.cache_warmer' shared service.

include_once $this->targetDirs[4].'/vendor/symfony/http-kernel/CacheWarmer/CacheWarmerInterface.php';
include_once $this->targetDirs[4].'/vendor/symfony/framework-bundle/CacheWarmer/AbstractPhpFileCacheWarmer.php';
include_once $this->targetDirs[4].'/vendor/symfony/framework-bundle/CacheWarmer/ValidatorCacheWarmer.php';

return $this->privates['validator.mapping.cache_warmer'] = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\ValidatorCacheWarmer(($this->privates['validator.builder'] ?? $this->load('getValidator_BuilderService.php')), ($this->targetDirs[0].'/validation.php'), ($this->privates['cache.validator'] ?? $this->load('getCache_ValidatorService.php')));
