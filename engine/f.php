<?php

namespace x\panel\task\fire {
    function c_k_editor__4($_) {
        // Process image upload
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return $_;
        }
        \extract($GLOBALS, \EXTR_SKIP);
        $blob = $_POST['upload'] ?? [];
        $out = ['uploaded' => false];
        if (!empty($blob['type']) && 0 !== \strpos($blob['type'], 'image/')) {
            $out['error']['message'] = \i('Please choose a valid image file.');
        } else {
            $name = $blob['name'] = \To::file((string) $blob['name']);
            $status = \store($folder = $_['folder'], $blob);
            if (false === $status) {
                $out['uploaded'] = true;
                $out['error']['code'] = 0;
                $out['error']['message'] = \i('File %s already exists.', [\strtr($folder . \D . $name, [\PATH => '.'])]);
                $out['url'] = \Hook::fire('link', [\To::URL($folder . \D . $name)]);
            } else if (\is_int($status)) {
                $out['error']['code'] = $status;
                $out['error']['message'] = \i('Failed to upload with status code: ' . $status);
            } else {
                $out['uploaded'] = true;
                $out['url'] = \Hook::fire('link', [\To::URL($status)]);
            }
        }
        \status(200);
        \type('application/json');
        echo \To::JSON($out);
        exit;
    }
}

namespace x\panel\type\field {
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
                'path' => 'asset' . (1 !== $user->status ? '/' . $user->user : ""),
                'query' => null,
                'task' => 'fire/c-k-editor.4'
            ])]),
            'stylesSet' => false
        ], require __DIR__ . \D . '..' . \D . 'state' . \D . 'c-k-editor.4.php', $value['state'] ?? []);
        return \x\panel\type\field\content($value, $key);
    }
}