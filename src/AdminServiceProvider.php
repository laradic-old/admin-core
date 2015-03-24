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

    /**
     * Path to resources folder, relative to $dir
     * @var string
     */
    protected $resourcesPath = '/../resources';

    protected $dir = __DIR__;

    protected $providers = [

        'Laradic\Admin\Providers\RouteServiceProvider',
       # 'Cartalyst\Sentry\SentryServiceProvider',
        'DaveJamesMiller\Breadcrumbs\ServiceProvider',
        'Cartalyst\Alerts\Laravel\AlertsServiceProvider'
    ];

    protected $aliases = [
       # 'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
        'Breadcrumbs' => 'DaveJamesMiller\Breadcrumbs\Facade',
        'Alert'  => 'Cartalyst\Alerts\Laravel\Facades\Alert'
    ];

    protected $routeMiddlewares = [
      #  'admin.auth'  => 'Laradic\Admin\Http\Middleware\Authenticate',
        #'admin.auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
       # 'admin.guest' => 'Laradic\Admin\Http\Middleware\RedirectIfAuthenticated',
        'sentry.auth' => 'Sentinel\Middleware\SentryAuth',
        'sentry.admin' => 'Sentinel\Middleware\SentryAdminAccess',
    ];

    public function boot()
    {
        parent::boot();
        $this->app->register('Sentinel\SentinelServiceProvider');
        \Breadcrumbs::setView('laradic/admin::partials.breadcrumbs');
    }

    /** @inheritdoc */
    public function register()
    {
        parent::register();

        /** @var \Illuminate\Foundation\Application $app */
        $app = $this->app;
        $app->make('config')->set('cartalyst.alerts.classes', [ 'error' => 'danger' ]);

        $app['url'] = $app->share(function (Application $app)
        {

            $routes = $app->runningInConsole() ? $app->make('router')->getRoutes() : $app->make('routes');

            return new AdminUrlGenerator(
                $routes,
                $app->rebinding('request', $this->requestRebinder()),
                config('laradic_admin.base_route')
            );
        });

        $app['redirect'] = $app->share(function (Application $app)
        {
            return new AdminRedirector($app->make('url'));
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
