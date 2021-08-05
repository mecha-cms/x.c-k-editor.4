<?php namespace x\panel\type\field;

function c_k_editor__4($value, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $value['state'] = \array_replace([
        'customConfig' => false,
        'stylesSet' => false,
        'language' => \explode('-', $state->language, 2)[0],
        'filebrowserImageBrowseUrl' => $_['/'] . '/::g::/asset' . (1 !== $user->status ? '/' . $user->key : "") . '/1',
        'filebrowserImageUploadUrl' => $url . '/.c-k-editor/blob/' . $user->token,
        'contentsCss' => \To::URL($f = __DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . 'css' . \DS . 'content' . (\defined("\\DEBUG") && \DEBUG ? '.' : '.min.') . 'css') . '?v=' . \dechex(\filemtime($f))
    ], require __DIR__ . DS . '..' . DS . 'state' . DS . 'editor.php', $value['state'] ?? []);
    return \x\panel\type\field\content($value, $key);
}
