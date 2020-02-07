<?php namespace _\lot\x\panel;

function Field__CKEditor($in, $key) {
    extract($GLOBALS, \EXTR_SKIP);
    $out = \_\lot\x\panel\h\field($in, $key);
    $options = \array_replace([
        'customConfig' => false,
        'stylesSet' => false,
        'language' => explode('-', $state->language, 2)[0],
        'filebrowserImageBrowseUrl' => $url . $_['/'] . '::g::/asset' . (1 !== $user->status ? '/' . $user->key : ""),
        'filebrowserImageUploadUrl' => $url . $_['/'] . '::s::/.c-k-editor/push/' . $user->token,
        'contentsCss' => \To::URL($f = __DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . 'css' . \DS . 'content' . (\defined("\\DEBUG") && \DEBUG ? "" : '.min') . '.css') . '?v=' . \dechex(\filemtime($f))
    ], require __DIR__ . DS . '..' . DS . 'state' . DS . 'editor.php', $in['state'] ?? []);
    $out['content'][2]['data-state'] = \json_encode($options);
    \_\lot\x\panel\h\c($out['content'][2], $in, ['textarea']);
    return \_\lot\x\panel\Field($out, $key);
}

if (
    (
        !empty($_GET['layout']) && (
        'page' === $_GET['layout'] ||
        0 === \strpos($_GET['layout'], 'page.')
    ) ||
    (
        ($f = $_['f']) &&
        false !== \strpos(',archive,draft,page,', ',' . \pathinfo($f, \PATHINFO_EXTENSION) . ',')
    )
)) {
    \Hook::set('_', function($_) {
        $type = $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['value'] ?? null;
        if (!$type || 'HTML' === $type || 'text/html' === $type) {
            // Load asset(s) only for pages with type of `HTML` or `text/html`
            \Asset::set(__DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . '@ckeditor' . \DS . 'ckeditor4' . \DS . 'ckeditor.js', 10);
            \Asset::set(__DIR__ . \DS . '..' . \DS . 'lot' . \DS . 'asset' . \DS . 'js' . \DS . 'c-k-editor' . (\defined("\\DEBUG") && \DEBUG ? "" : '.min') . '.js', 10.1);
            // Replace field type only for pages with type of `HTML` or `text/html`
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['content']['type'] = 'CKEditor';
            // Force page `type` value to `HTML`
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['type'] = 'hidden';
            $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['page']['lot']['fields']['lot']['type']['value'] = 'HTML';
        }
        return $_;
    });
    // Force initial page `type` value to `HTML` when user starts creating a new page
    \State::set('x.page.page.type', 'HTML');
}
