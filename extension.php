<?php

use Illuminate\Contracts\Foundation\Application;
use Laradic\Extensions\Extension;
use Laradic\Extensions\ExtensionFactory;
use Symfony\Component\VarDumper\VarDumper;

return array(
    'name' => 'Admin',
    'slug' => 'laradic/admin',
    'dependencies' => [
        'laradic/packadic'
    ],
    'paths' => [
        'migrations' => [base_path('vendor/rydurham/sentinel/src/migrations')],
        #'seeds' => [base_path('vendor/rydurham/sentinel/src/seeds')]
    ],
    'seeds' => [
        #base_path('vendor/rydurham/sentinel/src/seeds/DatabaseSeeder.php') => 'SentinelDatabaseSeeder'
    ],
    'register' => function(Application $app, Extension $extension, ExtensionFactory $extensions)
    {
        $app->register('Laradic\Admin\AdminServiceProvider');
    },
    'boot' => function(Application $app, Extension $extension, ExtensionFactory $extensions)
    {
    },
    'pre_install' => function(Application $app, Extension $extension, ExtensionFactory $extensions)
    {
       # $exists = $app->make('migrator')->getRepository()->repositoryExists();
        Debugger::dump('pre_install');
        $app->register('Laradic\Admin\AdminServiceProvider');
    },
    'pre_uninstall' => function(Application $app, Extension $extension, ExtensionFactory $extensions)
    {
        Debugger::dump('pre_uninstall');
        $app->register('Laradic\Admin\AdminServiceProvider');
    }
);
