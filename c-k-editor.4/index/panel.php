<?php

if (
    isset($_GET['layout']) && 0 === strpos($_GET['layout'] . '.', 'page.') ||
    ($f = $_['f']) && false !== strpos(',archive,draft,page,', ',' . pathinfo($f, PATHINFO_EXTENSION) . ',')
) {
    require __DIR__ . DS . '..' . DS . 'engine' . DS . 'r' . DS . 'hook.php';
    require __DIR__ . DS . '..' . DS . 'engine' . DS . 'r' . DS . 'state.php';
}
