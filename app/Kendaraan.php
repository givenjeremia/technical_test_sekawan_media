<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    //
    protected $table = "kendaraan";
    public $timestamps = false;
    public function riwayatKendaraan(){
        return $this->hasMany('App\RiwayatKendaraan','kendaraan_id','id');
        
    }
    public function penyewaan(){
        return $this->hasMany('App\Penyewaan','kendaraan_id','id');
    }
}
