<?php

Breadcrumbs::for('admin.auth.auction-user.buyers-index', function ($trail) {
   
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.user-type.user-type'), route('admin.auth.auction-user.buyers-index'));
});

Breadcrumbs::for('admin.auth.auction-user.sellers-index', function ($trail){

    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.user-type.user-type'), route('admin.auth.auction-user.sellers-index'));
});