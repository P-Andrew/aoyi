<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Baum;

class Category extends Baum\Node
{
    protected $table = 'categories';
    protected $guarded = array('id','parent_id','lft','rgt','depth');

    public function subDish(){
        return $this->hasMany('App\Dish','category_id');
    }

}
