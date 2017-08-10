<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent;

////////////////////////////////////////////////////////////////

class UserInfo extends AModel implements IInfo
{
	use TUsingPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'user_info';

	/**
	 * Method scopeNickLike
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  string $likes
	 *
	 * @return Eloquent\Builder
	 */
	public function scopeNickLike( Eloquent\Builder$builder, string$likes ):Eloquent\Builder
	{
		return $builder->where( 'nickname', 'like', "%$likes%" );
	}

}
