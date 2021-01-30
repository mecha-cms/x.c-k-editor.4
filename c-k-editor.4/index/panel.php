<?php

require __DIR__ . DS . '..' . DS . 'engine' . DS . 'r' . DS . 'asset.php';

if (0 === strpos($_['type'] . '/', 'page/') && Request::is('Get') && $site->is('page')) {
    require __DIR__ . DS . '..' . DS . 'engine' . DS . 'r' . DS . 'hook.php';
    require __DIR__ . DS . '..' . DS . 'engine' . DS . 'r' . DS . 'state.php';
}
