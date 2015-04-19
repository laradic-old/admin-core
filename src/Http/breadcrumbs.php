<?php

Navigation::registerBreadcrumbs([
    'home' => [
        'Dashboard',
        [
            'sentinel.login'  => ['Login'],
            'sentinel.logout' => ['Logout'],
            'sentinel.users.index'  => [
                'Users',
                [
                    'sentinel.users.create' => ['Create user'],
                    'sentinel.users.edit' => ['Edit user'],
                    'sentinel.users.show' => ['View user'],
                    'sentinel.profile.edit' => ['Edit profile'],
                    'sentinel.profile.show' => ['View user profile'],
                    'sentinel.groups.create' => ['Create group'],
                    'sentinel.groups.edit' => ['Edit group'],
                    'sentinel.groups.show' => ['View group'],

                ]
            ],
            'laradic.admin.attributes.index' => ['Attributes']
        ]
    ]
]);


/*
Breadcrumbs::register('home', function (Generator $breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('home'));
});

Breadcrumbs::register('login', function (Generator $breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Login', route('sentinel.login'));
});

Breadcrumbs::register('logout', function (Generator $breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Logout', route('sentinel.logout'));
});

Breadcrumbs::register('users', function (Generator $breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Users', route('sentinel.users.index'));
});

Breadcrumbs::register('users.create', function (Generator $breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Create user', route('sentinel.users.create'));
});
*/
