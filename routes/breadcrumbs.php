<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function($trait) {
    $trait->push('Home', route('home'));
});
