<?php

use Symfony\CS\Config\Config;
use Symfony\CS\Finder\DefaultFinder;
use Symfony\CS\Fixer\Contrib\HeaderCommentFixer;
use Symfony\CS\FixerInterface;

$finder = DefaultFinder::create()
    ->in(__DIR__)
;

return Config::create()
    ->level(FixerInterface::NONE_LEVEL)
    ->finder($finder)
    ->setUsingLinter(true)
    ->setUsingCache(true)
    ->fixers([
        'function_declaration',
        'line_after_namespace',
        'trailing_spaces',
        'extra_empty_lines',
        'function_typehint_space',
        'whitespacy_lines',
        'short_array_syntax',
    ]);
