<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('storage')
    ->exclude('node_modules');

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP71Migration'             => true,
        '@PSR12'                      => true,
        '@PhpCsFixer'                 => true,
        'blank_line_before_statement' => [
            'statements' => [
                'declare', 'exit', 'goto', 'include', 'include_once', 'require', 'require_once', 'return', 'switch', 'throw', 'try',
            ],
        ],
        'multiline_whitespace_before_semicolons'    => ['strategy' => 'no_multi_line'],
        'method_separation'                         => true,
        'no_multiline_whitespace_before_semicolons' => true,
        'single_quote'                              => true,
        'binary_operator_spaces'                    => [
            'operators' => [
            ],
        ],
        'braces' => [
            'allow_single_line_closure' => true,
        ],
        'hash_to_slash_comment' => true,
        'array_push'            => true,
        'concat_space'          => ['spacing' => 'one'],
        'yoda_style'            => false,
    ])
    ->setLineEnding("\n")
    ->setFinder($finder);
