<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent;

////////////////////////////////////////////////////////////////

class Shop extends AModel
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'shop';

	/**
	 * Method isTablePrivate
	 *
	 * @access protected
	 *
	 * @return bool
	 */
	protected function isTablePrivate():bool
	{
		return false;
	}

	/**
	 * Method scopeNamed
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  string $name
	 *
	 * @return Eloquent\Builder
	 */
	public function scopeNamed( Eloquent\Builder$builder, string$name ):Eloquent\Builder
	{
		return $this->where( 'name', $name );
	}

}
