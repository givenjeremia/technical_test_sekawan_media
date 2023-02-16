<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $table = "driver";
    public $timestamps = false;

    public function penyewaan(){
        return $this->hasMany('App\Penyewaan','driver_id','id');
    }
}
