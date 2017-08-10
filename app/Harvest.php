<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    protected $table = 'harvest';

    protected $fillable = array('id','harvest_num','status','dish_id','user_id','created_at');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function dish()
    {
        return $this->belongsTo('App\Dish','dish_id');
    }
}
