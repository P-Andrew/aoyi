<?php

namespace ShareBuy\Facades;

use Illuminate\Support\Facades\Facade;

////////////////////////////////////////////////////////////////

/**
 * @see \ShareBuy\Shopkeeper
 */
class Shopkeeper extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'share_buy_shopkeeper';
	}

}
