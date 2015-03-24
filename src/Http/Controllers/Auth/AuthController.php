<?php namespace Laradic\Admin\Http\Controllers\Auth;

use Cartalyst\Sentry\Sentry;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Application;
use Laradic\Admin\Auth\AuthenticatesAdmins;
use Laradic\Admin\Http\Controllers\Controller;

class AuthController extends Controller
{


    use AuthenticatesAdmins;

    protected $redirectPath;

    protected $loginPath;

    protected $app;
    public function authenticate()
    {
        return \Response::make('auth');
    }
    /**
     * Create a new filter instance.
     *
     * @param Application $app
     * @param  Guard $sentry
     *
     */
    public function __construct(Application $app, Sentry $sentry)
    {


        $this->sentry       = $sentry;
        $this->app          = $app;
        $this->redirectPath = config('laradic_admin.login_redirect');
        $this->loginPath    = 'auth/login';
        $this->middleware('admin.guest');
    }

}
