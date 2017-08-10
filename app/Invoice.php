<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = array('id','title','tax_number','order_number','cash','address','phone','bank_account','class','user_id','created_at');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
