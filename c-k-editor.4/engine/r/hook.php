<?php

Hook::set('_', function($_) {
    $type = $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['value'] ?? null;
    if (!$type || 'HTML' === $type || 'text/html' === $type) {
        // Load asset(s) only for pages with type of `HTML` or `text/html`
        require __DIR__ . DS . 'asset.php';
        // Replace field type to `CKEditor` only for pages with type of `HTML` or `text/html`
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['content']['type'] = 'CKEditor';
        // Force page `type` value to `HTML`
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['type'] = 'hidden';
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['value'] = 'HTML';
    }
    return $_;
});
