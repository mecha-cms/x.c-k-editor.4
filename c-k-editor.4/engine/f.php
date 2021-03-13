<?php namespace x\panel\type\field;

function CKEditor__4($value, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $out = \x\panel\to\field($value, $key);
    $options = \array_replace([
        'customConfig' => false,
        'stylesSet' => false,
        'language' => \explode('-', $state->language, 2)[0],
        'filebrowserImageBrowseUrl' => $url . $_['/'] . '/::g::/asset' . (1 !== $user->status ? '/' . $user->key : "") . '/1',
        'filebrowserImageUploadUrl' => $url . '/.c-k-editor/blob/' . $user->token,
        'contentsCss' => \To::URL($f = __DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . 'css' . \DS . 'content' . (\defined("\\DEBUG") && \DEBUG ? '.' : '.min.') . 'css') . '?v=' . \dechex(\filemtime($f))
    ], require __DIR__ . DS . '..' . DS . 'state' . DS . 'editor.php', $value['state'] ?? []);
    $out['content'][2]['data-state'] = \json_encode($options);
    \x\panel\_set_class($out['content'][2], [
        'code' => true,
        'textarea' => true
    ]);
    return \x\panel\type\field($out, $key);
}
