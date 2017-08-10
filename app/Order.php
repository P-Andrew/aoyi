<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = array('id','price','user_id','ground_id','status','order_number','pay_type');

    public function ground()
    {
        return $this->belongsTo('App\Ground','ground_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
