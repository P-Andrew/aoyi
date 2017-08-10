<?php

namespace ShareBuy;

////////////////////////////////////////////////////////////////

class Visitor
{

	/**
	 * Var id
	 *
	 * @access protected
	 *
	 * @var    int | null
	 */
	protected $id;

	/**
	 * Method __construct
	 *
	 * @access public
	 */
	public function __construct()
	{
		$shop= shop_name();

		$this->id= $_SESSION['share']['user'][$shop]['id']??null;
	}

	/**
	 * Method getId
	 *
	 * @access public
	 *
	 * @return int | null
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * Method user
	 *
	 * @access public
	 *
	 * @return Models\User
	 */
	public function user():Models\User
	{
		return Models\User::find($this->id);
	}

	/**
	 * Method exists
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function exists():bool
	{
		return !!$this->id;
	}

}
