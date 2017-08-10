<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };
use ShareBuy\Exceptions as E;
use function \ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class OrderDetail extends AModel
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'order_detail';

	/**
	 * Belongs to a/an order relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function order():R\BelongsTo
	{
		return $this->belongsTo( Order::class );
	}

}
