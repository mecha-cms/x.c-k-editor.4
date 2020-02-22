<?php namespace _\lot\x\panel;

function Field__CKEditor($in, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $out = \_\lot\x\panel\h\field($in, $key);
    $options = \array_replace([
        'customConfig' => false,
        'stylesSet' => false,
        'language' => explode('-', $state->language, 2)[0],
        'filebrowserImageBrowseUrl' => $url . $_['/'] . '::g::/asset' . (1 !== $user->status ? '/' . $user->key : ""),
        'filebrowserImageUploadUrl' => $url . '/.c-k-editor/blob/' . $user->token,
        'contentsCss' => \To::URL($f = __DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . 'css' . \DS . 'content' . (\defined("\\DEBUG") && \DEBUG ? "" : '.min') . '.css') . '?v=' . \dechex(\filemtime($f))
    ], require __DIR__ . DS . '..' . DS . 'state' . DS . 'editor.php', $in['state'] ?? []);
    $out['content'][2]['data-state'] = \json_encode($options);
    \_\lot\x\panel\h\c($out['content'][2], $in, ['textarea', 'code']);
    return \_\lot\x\panel\Field($out, $key);
}