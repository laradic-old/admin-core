<?php
 /**
 * Part of the Radic packages.
 */
namespace Laradic\Admin\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;

/**
 * Class AdminUrlGenerator
 *
 * @package     Laradic\Admin
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
class AdminUrlGenerator extends UrlGenerator
{
    protected $adminRoutePrefix;

    /**
     * Create a new admin URL Generator instance.
     *
     * @param  \Illuminate\Routing\RouteCollection  $routes
     * @param  \Illuminate\Http\Request  $request
     * @param string $adminRoutePrefix
     * @return void
     */
    public function __construct(RouteCollection $routes, Request $request, $adminRoutePrefix)
    {
        $this->routes = $routes;

        $this->setRequest($request);

        $this->adminRoutePrefix = $adminRoutePrefix;
    }
    /**
 * Instanciates the class
 */
    public function toAdmin($path = '', $extra = array(), $secure = null)
    {
        return $this->to($this->adminRoutePrefix . '/' . $path, $extra, $secure);
    }
}
