<?php namespace Laradic\Admin\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
	#
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'admin.auth' => 'Laradic\Admin\Http\Middleware\Authenticate',
		#'admin.auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'Laradic\Admin\Http\Middleware\RedirectIfAuthenticated',
	];

}

