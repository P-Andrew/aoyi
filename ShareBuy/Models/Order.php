<?php

namespace ShareBuy\Models;

use Illuminate\Database\Eloquent\{ Relations as R , Builder };
use ShareBuy\Exceptions as E;
use function \ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class Order extends AModel
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'order';

	/**
	 * Belongs to a/an user relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function user():R\BelongsTo
	{
		return $this->belongsTo( User::class, 'shop_user_id' );
	}

	/**
	 * Belongs to a/an addr relationship
	 *
	 * @access public
	 *
	 * @return R\BelongsTo
	 */
	public function addr():R\BelongsTo
	{
		if( $this->exists )
		{
			return $this->belongsTo( Addr::class, 'user_id', 'user_id' )->where( 'id',$this->addr_id );
		}else{
			$orderTable= $this->getTable();
			$addrTable= Addr::tableName();

			return $this->belongsTo( Addr::class, 'user_id', 'user_id' )->whereColumn( "$addrTable.id","$orderTable.addr_id" );
		}
	}

	/**
	 * Has many details relationship
	 *
	 * @access public
	 *
	 * @return R\HasMany
	 */
	public function details():R\HasMany
	{
		return $this->hasMany( OrderDetail::class );
	}

	/**
	 * Scope feedbacked
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  bool $feedbacked
	 *
	 * @return Builder
	 */
	public function scopeFeedbacked( Builder$builder, bool$feedbacked=true ):Builder
	{
		return $builder->where( 'feedback_status', ($feedbacked? '=' : '<>' ), 'active' );
	}

	/**
	 * Scope payed
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 *
	 * @return Builder
	 */
	public function scopePayed( Builder$builder ):Builder
	{
		return $builder->whereIn( 'status', [ 'payed', 'sending', 'sended', 'done', ] );
	}

	/**
	 * Scope inArea
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  IAreaAble $builder
	 *
	 * @return Builder
	 */
	public function scopeInArea( Builder$builder, IAreaAble$area ):Builder
	{
		return $builder->whereHas( 'addr', function( Builder$builder )use( $area ){
			$area->province and $builder->where( 'province', $area->province );
			$area->city and $builder->where( 'city', $area->city );
			$area->area and $builder->where( 'area', $area->area );
		} );
	}

	/**
	 * Getter of code
	 *
	 * @access public
	 *
	 * @return string
	 */
	public function getCodeAttribute():string
	{
		return date('YmdHis',$this->attributes['create_time']).strtoupper(dechex($this->attributes['id']));
	}

}
