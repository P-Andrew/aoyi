<?php

namespace ShareBuy;

////////////////////////////////////////////////////////////////

class Shopkeeper
{

	/**
	 * Var id
	 *
	 * @access protected
	 *
	 * @var    array | null
	 */
	protected $id;

	/**
	 * Method __construct
	 *
	 * @access public
	 */
	public function __construct()
	{
		$this->data= $_SESSION['share']['shopkeeper']??null;
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
		return $this->data['id']??null;
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
		return !!$this->data;
	}

	/**
	 * Method username
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function username():string
	{
		return $this->data['username']??'';
	}

}
