<?php namespace Laradic\Admin\Attributes\Relations;
/**
 * Part of the Attributes package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Attributes
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class EavValues extends MorphMany {

	/**
	 * {@inheritDoc}
	 */
	public function match(array $models, Collection $results, $relation)
	{
		$dictionary = $this->buildDictionary($results);

		// Once we have the dictionary we can simply spin through the parent models to
		// link them up with their children using the keyed dictionary to make the
		// matching very convenient and easy work. Then we'll just return them.
		foreach ($models as $model)
		{
			$key = $model->getKey();

			if (isset($dictionary[$key]))
			{
				$value = $this->getRelationValue($dictionary, $key, 'many');

				$model->setRelation($relation, $value);

				$this->mergeValues($model, $value);
			}
		}

		return $models;
	}

	/**
	 * Merges EAV "values" into the entity model, for easy access and
	 * manipulation.
	 *
	 * @param  \Illuminate\Database\Eloquent\Model  $model
	 * @param  \Illuminate\Database\Eloquent\Collection  $collection
	 * @return void
	 */
	protected function mergeValues(Model $model, Collection $values)
	{
		foreach ($values as $value)
		{
			$attribute = $value->getRelation($value->getAttributeRelation());
			$model->setAttribute($attribute->getAttributeKey(), $value->getValueKey());
		}
	}

}
