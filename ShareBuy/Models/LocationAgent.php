<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };
use ShareBuy\Exceptions as E;
use function \ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class LocationAgent extends AModel implements IAreaAble
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'location_agent';

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'shop_user_id';

	/**
	 * Belongs to a/an user relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function user():R\BelongsTo
	{
		return $this->belongsTo( User::class, 'shop_user_id' );
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
	 * Scope hasArea
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  IAreaAble $area
	 *
	 * @return Builder
	 */
	public function scopeHasArea( Builder$builder, IAreaAble$area ):Builder
	{
		return $builder
			->whereNested( function( $builder )use( $area ){  $builder->where( 'province', $area->province )->orWhereNull( 'province' );  })
			->whereNested( function( $builder )use( $area ){  $builder->where( 'city', $area->city )->orWhereNull( 'city' );  })
			->whereNested( function( $builder )use( $area ){  $builder->where( 'area', $area->area )->orWhereNull( 'area' );  })
		;
	}

	/**
	 * Getter of levelLabel
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function getLevelLabelAttribute():string
	{
		return [
			'province'=> '省代',
			'city'=> '市代',
			'area'=> '区/县代',

		][$this->attributes['level']];
	}

}
