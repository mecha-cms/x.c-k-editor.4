<?php

$_['asset']['panel.c-k-editor.4:0'] = [
    'id' => false,
    'path' => __DIR__ . DS . '..' . DS . '..' . DS . 'lot' . DS . 'asset' . DS . '@ckeditor' . DS . 'ckeditor4' . DS . 'ckeditor.js',
    'stack' => 10
];

$_['asset']['panel.c-k-editor.4:1'] = [
    'id' => false,
    'path' => __DIR__ . DS . '..' . DS . '..' . DS . 'lot' . DS . 'asset' . DS . 'js' . DS . 'c-k-editor' . (defined('DEBUG') && DEBUG ? '.' : '.min.') . 'js',
    'stack' => 20.1
];

// Buggy! :(
$_['asset']['style'][] = [
    'content' => ".lot\\:field .cke_chrome{width:100%!important}",
    'stack' => 20
];
