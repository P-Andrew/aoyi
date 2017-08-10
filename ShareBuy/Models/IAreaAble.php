<?php

namespace ShareBuy\Models;

////////////////////////////////////////////////////////////////

interface IAreaAble
{

	/**
	 * Getter of province
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	function getProvinceAttribute();

	/**
	 * Getter of city
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	function getCityAttribute();

	/**
	 * Getter of area
	 *
	 * @abstract
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	function getAreaAttribute();

}
