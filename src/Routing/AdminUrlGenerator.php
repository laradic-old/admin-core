<?php
 /**
 * Part of the Radic packages.
 */
namespace LaradicAdmin\Core\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;

/**
 * Class AdminUrlGenerator
 *
 * @package     LaradicAdmin\Core
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
     * @param  \Illuminate\Routing\RouteCollection $routes
     * @param  \Illuminate\Http\Request            $request
     * @param string                               $adminRoutePrefix
     */
    public function __construct(RouteCollection $routes, Request $request, $adminRoutePrefix)
    {
        $this->routes = $routes;

        $this->setRequest($request);

        $this->adminRoutePrefix = $adminRoutePrefix;
    }

    /**
     * Instanciates the class
     *
     * @param string $path
     * @param array  $extra
     * @param null   $secure
     * @return string
     */
    public function toAdmin($path = null, $extra = array(), $secure = null)
    {
        return $this->to($this->adminRoutePrefix . isset($path) ? '/' . $path : '', $extra, $secure);
    }
}
