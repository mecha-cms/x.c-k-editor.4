<?php

// Process image upload
Route::set('.c-k-editor/blob/:token', 200, function($token) {
    extract($GLOBALS, EXTR_SKIP);
    $out = ['uploaded' => false];
    if ($token !== $user->token) {
        $out['error']['message'] = i('Invalid token.');
    }
    $blob = Post::get('upload');
    if (!empty($blob['type']) && 0 !== strpos($blob['type'], 'image/')) {
        $out['error']['message'] = i('Please choose a valid image file.');
    } else {
        $name = $blob['name'] = ltrim(To::file($blob['name']), '-');
        $x = Path::X($name);
        $folder = LOT . DS . 'asset' . DS . (1 === $user->status ? $x : $user->key . DS . $x);
        $response = File::push($blob, $folder);
        if (false === $response) {
            $out['uploaded'] = true;
            $out['error']['code'] = 0;
            $out['error']['message'] = i('File %s already exists.', [strtr($folder . DS . $name, [ROOT => '.'])]);
            $out['url'] = To::URL($folder . DS . $name);
        } else if (is_int($response)) {
            $out['error']['code'] = $response;
            $out['error']['message'] = i('Failed to upload with error code: ' . $response);
        } else {
            $out['uploaded'] = true;
            $out['url'] = To::URL($response);
        }
    }
    $this->type('application/json');
    $this->content(To::JSON($out));
}, 0);
