<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'translation.extractor' shared service.

include_once $this->targetDirs[4].'/vendor/symfony/translation/Extractor/AbstractFileExtractor.php';
include_once $this->targetDirs[4].'/vendor/symfony/translation/Extractor/ExtractorInterface.php';
include_once $this->targetDirs[4].'/vendor/symfony/translation/Extractor/PhpExtractor.php';
include_once $this->targetDirs[4].'/vendor/symfony/twig-bridge/Translation/TwigExtractor.php';
include_once $this->targetDirs[4].'/vendor/symfony/translation/Extractor/ChainExtractor.php';

$this->privates['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();

$instance->addExtractor('php', new \Symfony\Component\Translation\Extractor\PhpExtractor());
$instance->addExtractor('twig', new \Symfony\Bridge\Twig\Translation\TwigExtractor(($this->services['twig'] ?? $this->getTwigService())));

return $instance;
