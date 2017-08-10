<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };
use ShareBuy\Exceptions as E;
use function \ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class UserStatus extends AModel
{
	use TPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'shop_user_status';

}
