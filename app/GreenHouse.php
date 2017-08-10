<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreenHouse extends Model
{
    //

    protected $table = 'greenhouse';
    protected $fillable = array('id','name','ground_num','desc');
    public function subGround(){
        return $this->hasMany('App\Ground','house_id');
    }
}
