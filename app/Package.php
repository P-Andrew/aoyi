<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $fillable = array('user_id','status','iphone','address','consignee','express');

    public function vest()
    {
        return $this->hasMany('App\Vest','package_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','uesr_id');
    }

}
