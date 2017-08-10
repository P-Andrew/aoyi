<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $table = 'system';
    protected $fillable = array('id','company_name','company_log','company_info','server_phone','company_address','pay_left_time','ground_left_time','help','about','desc');
}
