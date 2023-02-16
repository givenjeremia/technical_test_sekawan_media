<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    //
    protected $table = "penyewaan";
    public $timestamps = false;

    public function kendaraan(){
        return $this->belongsTo('App\Kendaraan','kendaraan_id');
    }
    public function driver(){
        return $this->belongsTo('App\Driver','driver_id');
    }

    public function persetujuan(){
        return $this->belongsToMany('App\User','persetujuan','penyewaan_id','users_id')->withPivot('tanggal_buat','tanggal_setuju','status');
    }

}
