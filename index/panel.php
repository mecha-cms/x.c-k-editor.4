<?php namespace x\panel\type\field;

function c_k_editor__4($value, $key) {
    \extract($GLOBALS, \EXTR_SKIP);
    $value['state'] = \array_replace([
        'contentsCss' => \Hook::fire('link', [\To::URL($file = __DIR__ . \D . '..' . \D . 'index' . (\defined("\\TEST") && \TEST ? '.' : '.min.') . 'css') . '?v=' . \filemtime($file)]),
        'customConfig' => false,
        'filebrowserImageBrowseUrl' => \Hook::fire('link', [\x\panel\to\link([
            'hash' => null,
            'part' => 1,
            'path' => 'asset' . (1 !== $user->status ? '/' . $user->user : ""),
            'query' => null,
            'task' => 'get'
        ])]),
        'filebrowserImageUploadUrl' => \Hook::fire('link', [\x\panel\to\link([
            'hash' => null,
            'part' => 0,
            'path' => 1 !== $user->status ? '/' . $user->user : "",
            'query' => null,
            'task' => 'fire/c-k-editor.4/' . $user->token
        ])]),
        'stylesSet' => false
    ], require __DIR__ . \D . '..' . \D . 'state' . \D . 'c-k-editor.4.php', $value['state'] ?? []);
    return \x\panel\type\field\content($value, $key);
}

\Hook::set('_', function ($_) {
    $_['asset']['c-k-editor.4'] = [
        'id' => false,
        'path' => __DIR__ . \D . '..' . \D . 'engine' . \D . 'vendor' . \D . '@ckeditor' . \D . 'ckeditor4' . \D . 'ckeditor.js',
        'stack' => 10
    ];
    // Buggy! :(
    $style = <<<CSS
.lot\:field .cke_chrome {
  width: 100%;
}
.lot\:field a.cke_button,
.lot\:field a.cke_combo_button {
  box-shadow: none;
}
.cke_dialog_ui_input_select,
.cke_dialog_ui_input_text,
.cke_dialog_ui_input_textarea {
  box-shadow: none;
}
.cke_dialog_ui_button {
  color: var(--color-button) !important;
}
.cke_dialog_ui_checkbox_input {
  position: relative !important;
}
.cke_dialog_ui_radio_input {
  position: relative !important;
}
.cke_btn_locked[role] {
  box-shadow: none;
  position: relative !important;
}
.cke_btn_reset[role] {
  box-shadow: none;
  position: relative !important;
}
.cke_btn_locked[role]::before,
.cke_btn_locked[role]::after {
  display: none !important;
}
.cke_btn_reset[role]::before,
.cke_btn_reset[role]::after {
  display: none !important;
}
CSS;
    $_['asset']['field/c-k-editor.4#style'] = [
        'id' => false,
        'link' => 'data:text/css;base64,' . \To::base64($style),
        'stack' => 20
    ];
    $_['asset']['field/c-k-editor.4'] = [
        'id' => false,
        'path' => __DIR__ . \D . '..' . \D . 'index' . (\defined("\\TEST") && \TEST ? '.' : '.min.') . 'js',
        'stack' => 20.1
    ];
    if ('GET' === $_SERVER['REQUEST_METHOD'] && 0 === \strpos($_['type'] . '/', 'page/')) {
        $type = $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['value'] ?? null;
        if (!$type || 'HTML' === $type || 'text/html' === $type) {
            // Replace field type to `c-k-editor.4` only for pages with type of `HTML` or `text/html`
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['content']['type'] = 'c-k-editor.4';
            // Force page `type` value to `HTML`
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['type'] = 'hidden';
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['value'] = 'HTML';
        }
    }
    return $_;
}, 20.1);

// Force initial page `type` value to `HTML` when user starts adding a new page
if ('set' === $_['task']) {
    \State::set('x.page.page.type', 'HTML');
}