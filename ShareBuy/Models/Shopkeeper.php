<?php

namespace ShareBuy\Models;

use Illuminate\Auth\Authenticatable as TAuthenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable as TAuthorizable;
use Illuminate\Contracts\Auth\{  Authenticatable as IAuthenticatable,  Access\Authorizable as IAuthorizable  };

////////////////////////////////////////////////////////////////

class Shopkeeper extends AModel implements IAuthenticatable, IAuthorizable
{
	use TAuthenticatable, TAuthorizable;

	use TPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'shopkeeper';

}
