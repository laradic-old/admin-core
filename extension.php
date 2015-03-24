<?php

use Illuminate\Contracts\Foundation\Application;
use Laradic\Extensions\Extension;
use Laradic\Extensions\ExtensionCollection;

return array(
    'name' => 'Admin',
    'slug' => 'laradic/admin',
    'dependencies' => [
        'laradic/packadic'
    ],
    'register' => function(Application $app, Extension $extension, ExtensionCollection $extensions)
    {
        $app->register('Laradic\Admin\AdminServiceProvider');

    },
    'boot' => function(Application $app, Extension $extension, ExtensionCollection $extensions)
    {
    },
    'install' => function(Application $app, Extension $extension, ExtensionCollection $extensions)
    {

    },
    'uninstall' => function(Application $app, Extension $extension, ExtensionCollection $extensions)
    {

    }
);
