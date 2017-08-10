<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dish';
    protected $fillable = array('id','name','desc','thumb','category_id','user_id','ground_id');

    public function topCategory(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function record(){
        return $this->hasMany('App\Record','dish_id');
    }
    public function harvest(){
        return $this->hasMany('App\Harvest','dish_id');
    }
    public function vest(){
        return $this->hasMany('App\vest','dish_id');
    }
}
