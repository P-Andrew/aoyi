<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = array('id','user_id','content');

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
