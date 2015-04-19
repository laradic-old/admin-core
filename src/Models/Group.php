<?php
 /**
 * Part of the Laradic packages.
 * MIT License and copyright information bundled with this package in the LICENSE file.
 * @author      Robin Radic
 * @license     MIT
 * @copyright   2011-2015, Robin Radic
 * @link        http://radic.mit-license.org
 */
namespace Laradic\Admin\Models;

use Laradic\Admin\Attributes\EntityTrait;
use Sentinel\Models\Group as BaseModel;

/**
 * Class User
 *
 * @package     Laradic\Admin\Models
 */
class Group extends BaseModel
{
    use EntityTrait;
}
