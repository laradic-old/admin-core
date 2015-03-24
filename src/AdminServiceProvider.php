<?php
/**
 * Part of the Radic packages.
 */
namespace Laradic\Admin;

use Illuminate\Foundation\Application;
use Laradic\Admin\Routing\AdminRedirector;
use Laradic\Admin\Routing\AdminUrlGenerator;
use Laradic\Support\ServiceProvider;

#@use ACL;

/**
 * Class AdminServiceProvider
 *
 * @package
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
class AdminServiceProvider extends ServiceProvider
{

    protected $configFiles = ['laradic_admin'];

    protected $resourcesPath = '/../resources';

    protected $dir = __DIR__;

    protected $providers = [
        'Laradic\Admin\Providers\RouteServiceProvider',

        'Laradic\Themes\ThemeServiceProvider',
        'DaveJamesMiller\Breadcrumbs\ServiceProvider',
        'Cartalyst\Alerts\Laravel\AlertsServiceProvider',
       # 'Cartalyst\Sentry\SentryServiceProvider'
    ];

    protected $aliases = [
        'Breadcrumbs' => 'DaveJamesMiller\Breadcrumbs\Facade',
        'Alert'  => 'Cartalyst\Alerts\Laravel\Facades\Alert'
    ];

    protected $routeMiddlewares = [
        'sentry.auth' => 'Sentinel\Middleware\SentryAuth',
        'sentry.admin' => 'Sentinel\Middleware\SentryAdminAccess',
    ];

    public function boot()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = parent::boot();
        $app->register('Sentinel\SentinelServiceProvider');
        $app->make('themes')->addPackagePublisher('laradic/admin', __DIR__ . '/../resources/theme');
        $app->make('breadcrumbs')->setView('laradic/admin::partials.breadcrumbs');
    }

    /** @inheritdoc */
    public function register()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = parent::register();

        $app->make('config')->set('cartalyst.alerts.classes', [ 'error' => 'danger' ]);

        $app['url'] = $app->share(function (Application $app)
        {
            $routes = $app->make('router')->getRoutes();

            return new AdminUrlGenerator(
                $routes,
                $app->rebinding('request', $this->requestRebinder()),
                config('laradic_admin.base_route')
            );
        });

        $app['redirect'] = $app->share(function (Application $app)
        {
            $redirector = new AdminRedirector($app->make('url'));
            $redirector->setSession($app->make('session.store'));
            return $redirector;
        });

        require_once __DIR__ . '/helpers.php';
    }

    protected function requestRebinder()
    {
        return function (Application $app, $request)
        {
            $app->make('url')->setRequest($request);
        };
    }
}
