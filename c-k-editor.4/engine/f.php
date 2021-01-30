<?php namespace _\lot\x\panel\type\field;

function c_k_editor__4($value, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $out = \_\lot\x\panel\to\field($value, $key);
    $options = \array_replace([
        'customConfig' => false,
        'stylesSet' => false,
        'language' => \explode('-', $state->language, 2)[0],
        'filebrowserImageBrowseUrl' => $url . $_['/'] . '/::g::/asset' . (1 !== $user->status ? '/' . $user->key : "") . '/1',
        'filebrowserImageUploadUrl' => $url . '/.c-k-editor/blob/' . $user->token,
        'contentsCss' => \To::URL($f = __DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . 'css' . \DS . 'content' . (\defined("\\DEBUG") && \DEBUG ? '.' : '.min.') . 'css') . '?v=' . \dechex(\filemtime($f))
    ], require __DIR__ . DS . '..' . DS . 'state' . DS . 'editor.php', $value['state'] ?? []);
    $out['content'][2]['data-state'] = \json_encode($options);
    \_\lot\x\panel\_set_class($out['content'][2], [
        'code' => true,
        'textarea' => true
    ]);
    return \_\lot\x\panel\type\field($out, $key);
}
