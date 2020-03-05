<?php

if (isset($_GET['CKEditor'])) {
    Hook::set('_', function($_) {
        if ('g' === $_['task'] && 0 === strpos($_['path'] . '/', 'asset/')) {
            $_['lot']['bar']['hidden'] = true;
            $_['lot']['desk']['lot']['form']['lot'][0]['hidden'] = true;
            if (!empty($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'])) {
                foreach ($_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['files']['lot']['files']['lot'] as $k => &$v) {
                    $x = pathinfo($k, PATHINFO_EXTENSION);
                    $v['tasks']['g']['hidden'] = true;
                    $v['tasks']['l']['hidden'] = true;
                    $v['tasks']['insert'] = [
                        'icon' => 'M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z',
                        'title' => 'Insert',
                        'description' => 'Insert',
                        'url' => false !== strpos(',gif,jpeg,jpg,png,svg,', ',' . $x . ',') ? 'javascript:insert(' . json_encode(To::URL($k)) . ');' : null,
                        'stack' => 10
                    ];
                }
            }
            return $_;
        }
    }, 20.1);
    Hook::set('get', function() {
        extract($GLOBALS);
        if ('g' === $_['task'] && 0 === strpos($_['path'] . '/', 'asset/')) {
            Asset::script('function insert(u){var w=this,o=w.opener;o.focus(),o.CKEDITOR.tools.callFunction(' . ($_GET['CKEditorFuncNum'] ?? 0) . ',u),w.close()}');
        }
    }, 20.2);
}
