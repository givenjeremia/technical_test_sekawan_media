<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatKendaraan extends Model
{
    //
    protected $table = "riwayat_kendaraan";
    public $timestamps = false;

    public function kendaraan(){
        return $this->belongsTo('App\Kendaraan','kendaraan_id');
    }


}
