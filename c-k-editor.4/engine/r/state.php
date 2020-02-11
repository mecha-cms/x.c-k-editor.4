<?php

// Force initial page `type` value to `HTML` when user starts adding a new page
if ('s' === $_['task']) {
    State::set('x.page.page.type', 'HTML');
}
