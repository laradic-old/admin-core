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


    #protected $configFiles = ['laradic_admin'];

    protected $resourcesPath = '/../resources';

    protected $dir = __DIR__;

    protected $providers = [
        'Laradic\Admin\Providers\RouteServiceProvider',
        'Laradic\Themes\ThemeServiceProvider',
        'Cartalyst\Alerts\Laravel\AlertsServiceProvider',
        'Chumper\Datatable\DatatableServiceProvider'
    ];

    protected $aliases = [
        'Alert'     => 'Cartalyst\Alerts\Laravel\Facades\Alert',
        'Datatable' => 'Chumper\Datatable\Facades\DatatableFacade'
    ];

    protected $routeMiddlewares = [
        'sentry.auth'  => 'Sentinel\Middleware\SentryAuth',
        'sentry.admin' => 'Sentinel\Middleware\SentryAdminAccess',
    ];


    public function provides()
    {
        return [ 'navigation' ];
    }

    public function boot()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = parent::boot();

        $app->make('breadcrumbs')->setView('laradic/admin::partials.breadcrumbs');
        require_once __DIR__ . '/Http/navigation.php';
    }

    /** @inheritdoc */
    public function register()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = parent::register();

        $config = $app->make('config');
        $config->set('cartalyst.alerts.classes', [ 'error' => 'danger' ]);


        $this->registerRouting();
        $this->registerSentinel();


        # Add sentry to the navigation factory so we can make use of hasAccess and all stuff that uses that
        $app->make('navigation')->setSentry($app->make('sentry'));

        require_once __DIR__ . '/helpers.php';
    }


    /**
     * Registers/binds the Sentinel/Sentry classes to the IOC container
     * and overrides the User and Group model
     */
    protected function registerSentinel()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = $this->app;

        /*
         * @todo fix redis cache and remove workaround
         * workaround enables registering SentinelServiceProvider in this class its register method
         * instead of boot
         */
        $app[ 'redis' ] = new \Illuminate\Redis\Database($this->app[ 'config' ][ 'database.redis' ]);
        $app->resolveProviderClass('Illuminate\Cache\CacheServiceProvider')->register();
        $app->register('Sentinel\SentinelServiceProvider');

    }

    /**
     * Registers/binds/overrides the Routing helper classes to the IOC container
     */
    protected function registerRouting()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = $this->app;

        $app[ 'url' ] = $app->share(
            function (Application $app)
            {
                $routes = $app->make('router')->getRoutes();

                return new AdminUrlGenerator(
                    $routes,
                    $app->rebinding('request', $this->requestRebinder()),
                    config('laradic/admin::base_route')
                );
            }
        );

        $app[ 'redirect' ] = $app->share(
            function (Application $app)
            {
                $redirector = new AdminRedirector($app->make('url'));
                $redirector->setSession($app->make('session.store'));

                return $redirector;
            }
        );
    }

    protected function requestRebinder()
    {
        return function (Application $app, $request)
        {
            $app->make('url')->setRequest($request);
        };
    }
}
