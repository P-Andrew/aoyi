<?php

namespace ShareBuy;

use Illuminate\Support\ServiceProvider;
use ShareBuy\{ Visitor, Shopkeeper };

////////////////////////////////////////////////////////////////

class ShareBuyServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		PHP_SESSION_NONE==session_status() and session_start();

		$this->app->singleton( 'share_buy_user', function(){
			return new Visitor();
		} );

		$this->app->singleton( 'share_buy_shopkeeper', function(){
			return new Shopkeeper();
		} );
	}
}
