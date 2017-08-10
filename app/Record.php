<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'crop_record';
    
    protected $fillable = array('id','crop_num','dish_id','user_id','created_at','status');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function dish()
    {
        return $this->belongsTo('App\Dish','dish_id');
    }
}

