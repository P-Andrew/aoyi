<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };

////////////////////////////////////////////////////////////////

class FormRecord extends AModel
{
	use TPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'form_record';

	/**
	 * Belongs to a/an form relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function form():R\BelongsTo
	{
		return $this->belongsTo( Form::class, 'form' );
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
		return $this->belongsTo( User::class, 'shop_user_id' );
	}

	/**
	 * Scope ofUser
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  User $user
	 *
	 * @return Builder
	 */
	public function scopeOfUser( Builder$builder, User$user ):Builder
	{
		return $builder->where( 'shop_user_id', $user->id );
	}

	/**
	 * Has many values relationship
	 *
	 * @access public
	 *
	 * @return R\HasMany
	 */
	public function values():R\HasMany
	{
		if( $this->exists )
		{
			return $this->hasMany( FormValue::class, 'form', 'form' )->where( 'shop_user_id',$this->shop_user_id )->where( 'record',$this->id );
		}else{
			$recordTable= $this->getTable();
			$volueTable= FormValue::tableName();

			return $this->hasMany( FormValue::class, 'form', 'form' )->whereColumn( "$recordTable.shop_user_id","$valueTable.shop_user_id" )->whereColumn( "$recordTable.record","$valueTable.id" );
		}
	}

}
