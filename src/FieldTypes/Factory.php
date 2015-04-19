<?php
/**
 * Part of the Laradic packages.
 * MIT License and copyright information bundled with this package in the LICENSE file.
 *
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
namespace Laradic\Admin\FieldTypes;

use ArrayAccess;
use Illuminate\Foundation\Application;
use Illuminate\View\Factory as View;
use InvalidArgumentException;
use Laradic\Themes\Assets\AssetGroup;

/**
 * Class Factory
 *
 * @package     Laradic\Admin\FieldTypes
 */
class Factory implements ArrayAccess
{

    protected $fieldTypes = array();

    protected $app;

    protected $assetGroup;

    protected $view;

    /**
     * Instantiates the class
     *
     * @param \Illuminate\Foundation\Application $app
     * @param \Laradic\Themes\Assets\AssetGroup  $assetGroup
     * @param \Illuminate\View\Factory           $view
     */
    public function __construct(Application $app, AssetGroup $assetGroup, View $view)
    {
        $this->app        = $app;
        $this->assetGroup = $assetGroup;
        $this->view       = $view;
    }

    public function register($slug, $type)
    {
        $this->set($slug, $type);
    }

    public function make($slug)
    {
        return $this->resolve($this->get($slug));
    }

    /**
     * resolve
     *
     * @param $type
     * @return BaseFieldType
     */
    protected function resolve($type)
    {
        if ( is_string($type) and class_exists($type) )
        {
            return new $type($this);
        }
        else
        {
            throw new InvalidArgumentException("Could not resolve FieldType [$type]");
        }
    }

    public function get($typeSlug)
    {
        return array_get($this->fieldTypes, $typeSlug);
    }

    public function has($typeSlug)
    {
        return array_has($this->fieldTypes, $typeSlug);
    }

    public function set($typeSlug, FieldType $type)
    {
        return array_set($this->fieldTypes, $typeSlug, $type);
    }

    /**
     * Get the value of fieldTypes
     *
     * @return array
     */
    public function getFieldTypes()
    {
        return $this->fieldTypes;
    }

    /**
     * Get the value of app
     *
     * @return \Illuminate\Foundation\Application
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Sets the value of app
     *
     * @param \Illuminate\Foundation\Application $app
     * @return \Illuminate\Foundation\Application
     */
    public function setApplication($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get the value of assetGroup
     *
     * @return \Laradic\Themes\Assets\AssetGroup
     */
    public function getAssetGroup()
    {
        return $this->assetGroup;
    }

    /**
     * Get the value of view
     *
     * @return \Illuminate\View\Factory
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Sets the value of view
     *
     * @param \Illuminate\View\Factory $view
     * @return \Illuminate\View\Factory
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }




    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed $typeSlug
     * @return bool
     */
    public function offsetExists($typeSlug)
    {
        return $this->has($typeSlug);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed $typeSlug
     * @return mixed
     */
    public function offsetGet($typeSlug)
    {
        return $this->get($typeSlug);
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed $typeSlug
     * @param  mixed $typeClass
     * @return void
     */
    public function offsetSet($typeSlug, $typeClass)
    {
        if ( is_array($typeSlug) )
        {
            foreach ($typeSlug as $innerKey => $innerValue)
            {
                $this->set($innerKey, $innerValue);
            }
        }
        else
        {
            $this->set($typeSlug, $typeClass);
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->set($key, null);
    }
}
