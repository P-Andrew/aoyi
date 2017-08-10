<?php

namespace ShareBuy\Models;

use Illuminate\Database\{  Eloquent,  Eloquent\Relations as R  };
use ShareBuy\Exceptions as E;
use function \ShareBuy\shop_name;

////////////////////////////////////////////////////////////////

class User extends AModel
{

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table= 'user';

	/**
	 * Method getInfoAttribute
	 *
	 * @access public
	 *
	 * @return IInfo
	 */
	public function getInfoAttribute():IInfo
	{
		return $this->userInfo??$this->tempInfo??(new TempInfo);
	}

	/**
	 * Method getMobileAttribute
	 *
	 * @access public
	 *
	 * @return ?string
	 */
	public function getMobileAttribute()
	{
		return ($this->user_id?
			\DB::connection( 'share_buy' )->table( 'user' )->where( 'id', $this->user_id )->first()->mobile??null
		:
			null
		);
	}

	/**
	 * Has a/an tempInfo relationship
	 *
	 * @access public
	 *
	 * @return R\HasOne
	 */
	public function tempInfo():R\HasOne
	{
		return $this->hasOne( TempInfo::class, 'shop_user_id' );
	}

	/**
	 * Has a/an userInfo relationship
	 *
	 * @access public
	 *
	 * @return R\HasOne
	 */
	public function userInfo():R\HasOne
	{
		return $this->hasOne( UserInfo::class, 'user_id', 'user_id' );
	}

	/**
	 * Method scopeIdIs
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  int $id
	 *
	 * @return Eloquent\Builder
	 */
	public function scopeIdIs( Eloquent\Builder$builder, int$id ):Eloquent\Builder
	{
		return $builder->where( 'id', $id );
	}

	/**
	 * Method scopeIdIs
	 *
	 * @access public
	 *
	 * @param  Builder $builder
	 * @param  mixed $ids
	 *
	 * @return Eloquent\Builder
	 */
	public function scopeIdIn( Eloquent\Builder$builder, $ids ):Eloquent\Builder
	{
		return $builder->whereIn( 'id', $ids );
	}

	/**
	 * Method recharge
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function recharge( float$amount, string$comment,$type='credit')
	{
		\DB::connection('share_buy')->transaction( function( $db )use( $amount, $comment,$type){
			$shop= shop_name();


			$db->table("private_{$shop}_account")->where('shop_user_id',$this->id)->increment('active_credit',$amount);

			if( $db->table("private_{$shop}_account")->where('shop_user_id',$this->id)->value('active_credit')<0 ){
				throw new E\NotSufficientFunds('余额不足');
			}

			$db->table("private_{$shop}_account")->where('shop_user_id',$this->id)->increment('apparent_credit',$amount);
			$db->table("private_{$shop}_account")->where('shop_user_id',$this->id)->increment('accumu_credit',$amount);
			$db->table("private_{$shop}_account_io")->insert([
				    'shop_user_id'=> $this->id,
				    'account_type'=> $type,
				              'io'=> $amount,
				         'io_type'=> 'recharge',
				     'user_status'=> 0,
				 'recharge_origin'=> 512,
				'recharge_comment'=> $comment,
				          'status'=> 'active',
				     'create_time'=> $_SERVER['REQUEST_TIME'],
				       'done_time'=> $_SERVER['REQUEST_TIME'],
				'last_change_time'=> $_SERVER['REQUEST_TIME'],
			] );
		} );
	}

	/**
	 * Has many area relationship
	 *
	 * @access public
	 *
	 * @return R\HasMany
	 */
	public function orders():R\HasMany
	{
		return $this->hasMany( Order::class, 'shop_user_id' );
	}

	/**
	 * Has a/an locationAgent relationship
	 *
	 * @access public
	 *
	 * @return R\HasOne
	 */
	public function locationAgent():R\HasOne
	{
		return $this->hasOne( LocationAgent::class, 'shop_user_id' )->where( 'stop', 0 );
	}

	/**
	 * Has a/an account relationship
	 *
	 * @access public
	 *
	 * @return R\HasOne
	 */
	public function account():R\HasOne
	{
		return $this->hasOne( Account::class, 'shop_user_id' );
	}

	/**
	 * Has a/an account relationship
	 *
	 * @access public
	 *
	 * @return R\HasMany
	 */
	public function accountIos():R\HasMany
	{
		return $this->hasMany( AccountIo::class, 'shop_user_id' );
	}

	/**
	 * Has many addrs relationship
	 *
	 * @access public
	 *
	 * @return R\HasMany
	 */
	public function addrs():R\HasMany
	{
		return $this->hasMany( Addr::class, 'user_id', 'user_id' );
	}

	/**
	 * Getter of status
	 *
	 * @access public
	 *
	 * @return UserStatus
	 */
	public function getStatusAttribute():UserStatus
	{
		return $this->account->userStatus;
	}

}
