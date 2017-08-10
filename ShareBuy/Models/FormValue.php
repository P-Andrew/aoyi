<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };

////////////////////////////////////////////////////////////////

class FormValue extends AModel
{
	use TPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'form_value';

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
	 * Belongs to a/an record relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function record():R\BelongsTo
	{
		if( $this->exists )
		{
			return $this->belongsTo( FormRecord::class, 'form', 'form' )->where( 'id',$this->record );
		}else{
			$valueTable= $this->getTable();
			$recordTable= FormRecord::tableName();

			return $this->belongsTo( FormRecord::class, 'form', 'form' )->whereColumn( "$recordTable.id","$valueTable.record" );
		}
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

}
