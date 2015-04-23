<?php
 /**
 * Part of the Radic packages.
 */
namespace Laradic\Admin\Routing;

use Illuminate\Routing\Redirector;

/**
 * Class AdminRedirector
 *
 * @package     Laradic\Admin\Routing
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
class AdminRedirector extends Redirector
{

    /**
     * @var \Laradic\Admin\Routing\AdminUrlGenerator
     */
    protected $generator;

    /**
     * Instanciates the class
     *
     * @param null  $path
     * @param int   $status
     * @param array $headers
     * @param null  $secure
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toAdmin($path = null, $status = 302, $headers = array(), $secure = null)
    {
        $path = $this->generator->toAdmin($path, array(), $secure);

        return $this->createRedirect($path, $status, $headers);
    }
}
