<?php

require __DIR__ . D . '..' . D . 'engine' . D . 'f.php';

if ('GET' === $_SERVER['REQUEST_METHOD']) {
    // Force initial page `type` value to `HTML` when user starts adding a new page
    if ('set' === $_['task']) {
        State::set('x.page.page.type', 'HTML');
    }
    // Modify the asset page component(s) when opened via the image uploader dialog
    if (isset($_GET['CKEditor'])) {
        Hook::set('_', function ($_) {
            if ('get' === $_['task'] && 0 === strpos($_['path'] . '/', 'asset/')) {
                $_['lot']['bar']['skip'] = true;
                $_['lot']['desk']['lot']['form']['lot'][0]['skip'] = true;
                $_['lot']['desk']['lot']['form']['lot'][2]['skip'] = true;
                if (!empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'])) {
                    foreach ($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'] as $k => &$v) {
                        $x = pathinfo($k, PATHINFO_EXTENSION);
                        $v['tasks']['get']['skip'] = true;
                        $v['tasks']['let']['skip'] = true;
                        $v['tasks']['insert'] = [
                            'description' => 'Insert',
                            'icon' => 'M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z',
                            'stack' => 10,
                            'title' => 'Insert',
                            'url' => false !== strpos(',gif,jpeg,jpg,png,svg,', ',' . $x . ',') ? 'javascript:insert(' . json_encode(Hook::fire('link', [To::URL($k)])) . ');' : null
                        ];
                    }
                    $_['asset'][] = [
                        'id' => false,
                        'link' => 'data:text/js;base64,' . To::base64('function insert(u){var w=this,o=w.opener;o.focus(),o.CKEDITOR.tools.callFunction(' . ($_GET['CKEditorFuncNum'] ?? 0) . ',u),w.close()}'),
                        'stack' => 10
                    ];
                }
                return $_;
            }
        }, 20.1);
    }
    Hook::set('_', function ($_) {
        if (0 === strpos($_['type'] . '/', 'page/')) {
            $_['asset']['c-k-editor.4'] = [
                'id' => false,
                'path' => __DIR__ . D . '..' . D . 'engine' . D . 'vendor' . D . '@ckeditor' . D . 'ckeditor4' . D . 'ckeditor.js',
                'stack' => 10
            ];
// Buggy! :(
$style = <<<CSS
.lot\:field .cke_chrome {
  width: 100%;
}
CSS;
            $_['asset']['field/c-k-editor.4#style'] = [
                'id' => false,
                'link' => 'data:text/css;base64,' . To::base64($style),
                'stack' => 20
            ];
            $_['asset']['field/c-k-editor.4'] = [
                'id' => false,
                'path' => __DIR__ . D . '..' . D . 'index' . (defined('TEST') && TEST ? '.' : '.min.') . 'js',
                'stack' => 20.1
            ];
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
}