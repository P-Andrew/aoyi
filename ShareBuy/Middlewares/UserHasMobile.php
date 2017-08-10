<?php

namespace ShareBuy\Middlewares;

////////////////////////////////////////////////////////////////

class UserHasMobile
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
		if( \Visitor::exists() && !\Visitor::user()->mobile ){
			if ($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			} else {
				return redirect()->to(url('../User/bind_mobile?referer='.urlencode(app('request')->url())));
			}
		}

		return $next($request);
	}
}
