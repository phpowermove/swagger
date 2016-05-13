<?php

use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;
use Symfony\CS\Fixer\Contrib\HeaderCommentFixer;
use Symfony\CS\FixerInterface;

$finder = DefaultFinder::create()
    ->in(__DIR__)
;

return Config::create()
    ->level(FixerInterface::PSR2_LEVEL)
    ->finder($finder)
    ->setUsingLinter(true)
    ->setUsingCache(true)
;
