<?php
 /**
 * Part of the Laradic packages.
 * MIT License and copyright information bundled with this package in the LICENSE file.
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
namespace Laradic\Admin\FieldTypes;
/**
 * Class TextFieldType
 *
 * @package     Laradic\Admin\FieldTypes
 */
class TextFieldType extends BaseFieldType implements FieldType
{
    protected $slug = 'text';

    /**
     * Instantiates the class
     *
     * @param \Laradic\Admin\FieldTypes\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        parent::__construct($factory);
        $this->setAttributes([
            'class' => 'form-control',
            'id' => $this->name
        ]);
    }
}
