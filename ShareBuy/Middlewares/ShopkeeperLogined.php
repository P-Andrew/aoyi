<?php

namespace ShareBuy\Middlewares;

////////////////////////////////////////////////////////////////

class ShopkeeperLogined
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  callable  $next
	 * @return mixed
	 */
	public function handle( $request, callable$next )
	{
		if( !\Shopkeeper::exists() ){
			if ($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->to(url('../Boss/Login/index.html?referer='.urlencode(app('request')->url())));
			}
		}

		return $next($request);
	}
}
