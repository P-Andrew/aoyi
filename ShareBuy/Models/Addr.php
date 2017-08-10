<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };
use ShareBuy\Exceptions as E;
use function \ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class Addr extends AModel implements IAreaAble
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'addr';

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
	 * Getter of province
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	public function getProvinceAttribute()
	{
		return $this->attributes['province'];
	}

	/**
	 * Getter of city
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	public function getCityAttribute()
	{
		return $this->attributes['city'];
	}

	/**
	 * Getter of area
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	public function getAreaAttribute()
	{
		return $this->attributes['area'];
	}

	/**
	 * Belongs to a/an user relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function user():R\BelongsTo
	{
		return $this->belongsTo( User::class, 'user_id', 'user_id' );
	}

}
