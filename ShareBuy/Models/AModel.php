<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent;
use function ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class AModel extends Eloquent\Model
{

	/**
	 * 去除统一的批量赋值限制，需要保护的字段可在具体模型中单独定义
	 *   批量赋值漏洞应当主要在业务逻辑中用 only 进行防御
	 *
	 * @var array
	 */
	protected $guarded= [];

	/**
	 * The connection name for the model.
	 *
	 * @var string
	 */
	protected $connection= 'share_buy';

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Method isTablePrivate
	 *
	 * @access protected
	 *
	 * @return bool
	 */
	protected function isTablePrivate():bool
	{
		return !property_exists( static::class, 'shopColumn' );
	}

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable()
	{
		if( $this->isTablePrivate() )
		{
			$shop= shop_name();

			return "private_{$shop}_{$this->table}";
		}else{
			return $this->table;
		}
	}

	/**
	 * Method queryTableName
	 *
	 * @access public
	 *
	 * @param  Builder $Builder
	 *
	 * @return string
	 */
	public function queryTableName( Eloquent\Builder$Builder ):string
	{
		return (new static())->getTable();
	}

	/**
	 * 资源名字
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @return string
	 */
	public static function resourceName():string
	{
		return snake_case(
			str_replace( '\\', '',
				preg_replace( '/\\\\(\\w+)\\\\\\1$/', '\1',
					str_replace( 'ShareBuy\\Models', '',
						static::class
					)
				)
			)
		);
	}

	/**
	 * 资源名字(复数)
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @return string
	 */
	public static function resourcesName():string
	{
		return str_plural( static::resourceName() );
	}

}
