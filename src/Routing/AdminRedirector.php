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
 */
    public function toAdmin($path, $status = 302, $headers = array(), $secure = null)
    {
        $path = $this->generator->toAdmin($path, array(), $secure);

        return $this->createRedirect($path, $status, $headers);
    }
}
