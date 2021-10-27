<?php

$author = '@author Marc MOREAU <to-define>';
$license = '@license private';
$link = '@link https://github.com/<to-define>/README.md';

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(false)
    ->setRules([
        '@Symfony' => true,
        'php_unit_test_class_requires_covers' => false,
        'header_comment' => [
            'header' => implode("\n", [$author, $license, $link]),
            'comment_type' => 'PHPDoc',
        ],
    ])
    ->setFinder($finder)
;

return $config;
