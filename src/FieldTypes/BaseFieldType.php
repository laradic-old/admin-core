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
use Debugger;

/**
 * Class BaseFieldType
 *
 * @package     Laradic\admin\src\FieldTypes
 */
abstract class BaseFieldType implements ArrayAccess
{

    protected $slug;

    protected $factory;

    protected $attributes;

    protected $value;

    protected $name;

    /**
     * Instantiates the class
     *
     * @param \Laradic\Admin\FieldTypes\Factory $factory
     * @param \Laradic\Themes\Assets\AssetGroup $assetGroup
     * @param \Illuminate\View\Factory          $view
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function getTypeSlug()
    {
        return $this->slug;
    }

    protected function getView()
    {
        return 'field-types::' . $this->getTypeSlug();
    }

    public function render()
    {
        #Debugger::dump(\Themes::addNamespace())
        return $this->factory->getView()->make($this->getView())->with([
            'slug' => $this->slug,
            'value' => $this->value,
            'attributes' => $this->attributes,
            'name' => $this->name,
            'assetGroupName' => 'field-types',
            'type' => $this
        ])->render();
    }

    /**
     * Get the value of attributes
     *
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the value of attributes
     *
     * @param mixed $attributes
     * @return mixed
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the value of value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value of value
     *
     * @param mixed $value
     * @return mixed
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name
     *
     * @param mixed $name
     * @return mixed
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Determine if an item exists at an offset.
     *
     * @param  mixed $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_has($this->attributes, $key);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  mixed $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return array_get($this->attributes, $key);
    }

    /**
     * Set the item at a given offset.
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if ( is_array($key) )
        {
            foreach ($key as $innerKey => $innerValue)
            {
                array_set($this->attributes, $innerKey, $innerValue);
            }
        }
        else
        {
            array_set($this->attributes, $key, $value);
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
        array_set($this->attributes, $key, null);
    }

}
