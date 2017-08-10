<?php

namespace ShareBuy\Models;

use function ShareBuy\shop_id;

////////////////////////////////////////////////////////////////

trait TPublicTable
{

	/**
	 * Var shopColumn
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @var    string
	 */
	protected static $shopColumn= 'shop';

	/**
	 * Method bootTPublicTable
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @return void
	 */
	public static function bootTPublicTable()
	{
		static::addGlobalScope( 'currentShop', function( $builder ){
			$builder->where( static::$shopColumn, shop_id() );
		} );
	}

}
