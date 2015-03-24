<?php

use DaveJamesMiller\Breadcrumbs\Generator;


function registerBreadcrumbs($crumbs, $parent = null)
{
    foreach($crumbs as $route => $crumb)
    {
        Breadcrumbs::register($route, function(Generator $breadcrumbs) use ($parent, $crumb, $route) {
            if(!is_null($parent)){
                $breadcrumbs->parent($parent);
            }
            $breadcrumbs->push($crumb[0], route($route));
        });
        if(isset($crumb[1]) and is_array($crumb[1]))
        {
            registerBreadcrumbs($crumb[1], $route);
        }
    }
}

registerBreadcrumbs([
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

                ]
            ],
            'sentinel.groups.index' => [
                'Groups',
                [
                    'sentinel.groups.create' => ['Create group'],
                    'sentinel.groups.edit' => ['Edit group'],
                    'sentinel.groups.show' => ['View group'],
                ]
            ]
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
