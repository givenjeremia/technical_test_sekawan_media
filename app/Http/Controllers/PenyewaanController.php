<?php

namespace App\Http\Controllers;

use App\User;
use App\Driver;
use App\Kendaraan;
use App\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $drivers = Driver::where('status',1)->get();
        $kendaraans = Kendaraan::where('jadwal_service','!=',Carbon::now()->toDateString())->get();
        $supervisis = User::where('role',1)->get();
        $manajers = User::where('role',2)->get();
        $penyewaan = Penyewaan::all();
        return view('penyewaan.index',compact('penyewaan','drivers','kendaraans','supervisis','manajers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Checking 
        $penyewaan = Penyewaan::where([
            ["tanggal_sewa",$request->get('tanggal_sewa')],
            // ["waktu_sewa",$request->get('waktu_sewa')],
            ["kendaraan_id",$request->get('kendaraan_id')],
            ["driver_id",$request->get('driver_id')],
        ])->get();
        // dd($penyewaan);
        if(count($penyewaan) > 0){
            return redirect()->route('penyewaan.index')->with('status', 'Penyewaan Gagal, Kendaraan Atau Driver Sudah Di Sewa');
        }
        else{
            $new = new Penyewaan();
            $new->tanggal_sewa = $request->get('tanggal_sewa');
            $new->waktu_sewa = $request->get('waktu_sewa');
            $new->keterangan = $request->get('keterangan');
            $kendaraan = Kendaraan::find($request->get('kendaraan_id'));
            $kendaraan->penyewaan()->save($new);
            $driver = Driver::find($request->get('driver_id'));
            $driver->penyewaan()->save($new);
            $new->persetujuan()->attach($request->get('manajer_id'), [
                'tanggal_buat' => Carbon::now()->toDateString(),
                'status' => 0
            ]);
            $new->persetujuan()->attach($request->get('supervisor_id'), [
                'tanggal_buat' => Carbon::now()->toDateString(),
                'status' => 0
            ]);
            return redirect()->route('penyewaan.index')->with('status', 'Berhasil Tambah Penyewaan');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function show(Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penyewaan)
    {
        //
        $data= Penyewaan::find($penyewaan);
        $data->tanggal_sewa = $request->get('tanggal_sewa');
        $data->waktu_sewa = $request->get('waktu_sewa');
        $data->keterangan = $request->get('keterangan');
        $data->save();
        return redirect()->route('penyewaan.index')->with('status', 'Berhasil Update Penyewaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penyewaan  $penyewaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyewaan $penyewaan)
    {
        //
    }
    public function getEditForm(Request $request){
        $id=$request->get('id');
        $data= Penyewaan::find($id);
    
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('penyewaan.update',compact('data'))->render()
        ),200);
    }
}
