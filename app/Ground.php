<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Ground extends Model
{

    protected $table = 'ground';
    protected $fillable = array('id','name','house_id','price','dish_num','status','user_id','croped_num','sort','able');
    public function topHouse(){
        return $this->belongsTo('App\GreenHouse','house_id');
    }
    public function order()
    {
        return $this->hasOne('App\Order','ground_id')->whereIn('status',[0,1]);
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public static function boot(){
        parent::boot();
        static::addGlobalScope('sort',function(Builder$builder){
            $builder->orderBy('sort','desc');
        });
    }
}
