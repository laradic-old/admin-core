<?php namespace Laradic\Admin\Http\Middleware;

use Cartalyst\Sentry\Sentry;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticated {

    /**
     * @var \Cartalyst\Sentry\Sentry
     */
    protected $sentry;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $sentry
     * @return void
     */
    public function __construct(Sentry $sentry)
    {
        $this->sentry = $sentry;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->sentry->check())
		{
			return new RedirectResponse(admin_url(config('laradic_admin.login_redirect')));
		}

		return $next($request);
	}

}
