<?php namespace Laradic\Admin\Http\Middleware;

use Cartalyst\Sentry\Sentry;
use Closure;

class Authenticate {

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


		if (! $this->sentry->check() or ($this->sentry->check() and ! $this->sentry->getUser()->hasAccess('admin')))
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->toAdmin('auth/login');

			}
		}

		return $next($request);
	}

}
