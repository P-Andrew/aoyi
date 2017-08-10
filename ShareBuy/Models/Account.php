<?php

namespace ShareBuy\Models;

use Illuminate\Database\{  Eloquent,  Eloquent\Relations as R  };
use ShareBuy\Exceptions as E;

////////////////////////////////////////////////////////////////

class Account extends AModel
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'account';

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

}
