<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };
use ShareBuy\Exceptions as E;

////////////////////////////////////////////////////////////////

class AccountIo extends AModel
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'account_io';

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
	 * Belongs to a/an userStatus relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function userStatus():R\BelongsTo
	{
		return $this->belongsTo( UserStatus::class, 'user_status' );
	}

	/**
	 * Scope typeOf
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  string $type
	 *
	 * @return Builder
	 */
	public function scopeTypeOf( Builder$builder, string$type ):Builder
	{
		return $builder->where( 'io_type', $type );
	}

}
