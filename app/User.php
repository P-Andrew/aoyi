<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ShareBuy\Models\TBelongsToShareBuyUser;

class User extends Authenticatable
{

    use TBelongsToShareBuyUser;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    public function feedback(){
        return $this->hasMany('App\Feedback','user_id');
    }
    public function ground()
    {
        return $this->hasMany('App\Ground','user_id');
    }
    public function order()
    {
        return $this->hasMany('App\Order','user_id');
    }
    public function record(){
        return $this->hasMany('App\Record','user_id');
    }
    public function harvest(){
        return $this->hasMany('App\Harvest','user_id');
    }
    public function vest(){
        return $this->hasMany('App\Vest','user_id');
    }
    public function package()
    {
        return $this->hasMany('App\Package','user_id');
    }
    public function invoice()
    {
        return $this->hasMany('App\Invoice','user_id');
    }
}
