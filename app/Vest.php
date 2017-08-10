<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vest extends Model
{
    protected $table = 'vest';

    protected $fillable = array('id','package_id','vest_num','dish_id','user_id','created_at');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function package()
    {
        return $this->belongsTo('App\package','package_id');
    }
    public function dish()
    {
        return $this->belongsTo('App\Dish','dish_id');
    }
}
