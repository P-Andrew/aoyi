<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent;
use function ShareBuy\shop_id;

////////////////////////////////////////////////////////////////

trait TUsingPublicTable
{

	/**
	 * Method isTablePrivate
	 *
	 * @access protected
	 *
	 * @return bool
	 */
	protected function isTablePrivate():bool
	{
		return false;
	}

	/**
	 * Method shopColumn
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected static function shopColumn():string
	{
		return '';
	}

	/**
	 * Method boot
	 *
	 * @access public
	 *
	 * @return void
	 */
	public static function bootTUsingPublicTable()
	{
		if( $shopColumn= static::shopColumn() )
		{
			static::addGlobalScope( 'ofCurrentShop', function( Eloquent\Builder$query )use($shopColumn):Eloquent\Builder{
				return $query->where( $shopColumn, shop_id() );
			} );
		}
	}

}
