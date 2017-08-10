<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent;

////////////////////////////////////////////////////////////////

class TempInfo extends AModel implements IInfo
{
	use TUsingPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'temp_info';

	/**
	 * Method shopColumn
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected static function shopColumn():string
	{
		return 'shop_id';
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
		return $builder->where( 'nickname', 'like', "%$likes%" );
	}

}
