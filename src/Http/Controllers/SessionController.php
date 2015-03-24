<?php namespace Laradic\Admin\Http\Controllers;

use Sentinel\Controllers\SessionController as BaseController;
use Sentry;
use View;

class SessionController extends BaseController
{


    /**
     * Show the login form
     */
    public function create()
    {
        // Is this user already signed in?
        if ( Sentry::check() )
        {
            return $this->redirectTo('session_store');
        }

        // No - they are not signed in.  Show the login form.
        return View::make('laradic/admin::sessions.login');
    }
}
