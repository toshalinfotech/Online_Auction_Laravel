<?php

Breadcrumbs::for('admin.auth.credit.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.credit.credit'), route('admin.auth.credit.index'));
});

Breadcrumbs::for('admin.auth.credit.create', function ($trail) {
    $trail->parent('admin.auth.credit.index');
    $trail->push(__('menus.backend.credit.create'), route('admin.auth.credit.create'));
});

Breadcrumbs::for('admin.auth.credit.edit', function ($trail, $id) {
    $trail->parent('admin.auth.credit.index');
    $trail->push(__('menus.backend.credit.edit'), route('admin.auth.credit.edit', $id));
});