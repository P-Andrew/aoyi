<?php

namespace ShareBuy\Facades;

use Illuminate\Support\Facades\Facade;

////////////////////////////////////////////////////////////////

/**
 * @see \ShareBuy\Visitor
 */
class Visitor extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'share_buy_user';
	}

}
