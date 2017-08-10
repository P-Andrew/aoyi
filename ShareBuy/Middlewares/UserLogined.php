<?php

namespace ShareBuy\Middlewares;

////////////////////////////////////////////////////////////////

class UserLogined
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
		if( !\Visitor::exists() ){
			if ($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->to(url('../Index/follow?h='.urlencode(app('request')->url())));
			}
		}

		return $next($request);
	}
}
