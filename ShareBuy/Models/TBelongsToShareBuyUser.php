<?php

namespace ShareBuy\Models;

use Illuminate\Database\{  Eloquent,  Eloquent\Relations as R  };

////////////////////////////////////////////////////////////////

trait TBelongsToShareBuyUser
{

	/**
	 * Belongs to a/an user relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function user():R\BelongsTo
	{
		return $this->belongsTo( User::class, 'id', 'id' );
	}

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
		$ids= array_unique(
			array_merge(
				TempInfo::nickLike( $likes )->pluck( 'shop_user_id' )->toArray()
				,
				User::IdIn(
					UserInfo::nickLike( $likes )->pluck( 'user_id' )
				)->pluck( 'id' )->toArray()
			)
		);

		return $builder->whereIn( 'id', $ids );
	}

}
