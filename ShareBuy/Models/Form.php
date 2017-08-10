<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };

////////////////////////////////////////////////////////////////

class Form extends AModel
{
	use TPublicTable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'form';

	/**
	 * Has many records relationship
	 *
	 * @access public
	 *
	 * @return R\HasMany
	 */
	public function records():R\HasMany
	{
		return $this->hasMany( FormRecord::class, 'form' );
	}

}
