<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'console.command.public_alias.doctrine_cache.stats_command' shared service.

include_once $this->targetDirs[4].'/vendor/symfony/console/Command/Command.php';
include_once $this->targetDirs[4].'/vendor/symfony/dependency-injection/ContainerAwareInterface.php';
include_once $this->targetDirs[4].'/vendor/doctrine/doctrine-cache-bundle/Command/CacheCommand.php';
include_once $this->targetDirs[4].'/vendor/doctrine/doctrine-cache-bundle/Command/StatsCommand.php';

return $this->services['console.command.public_alias.doctrine_cache.stats_command'] = new \Doctrine\Bundle\DoctrineCacheBundle\Command\StatsCommand();
