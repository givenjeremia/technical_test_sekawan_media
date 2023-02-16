<?php

namespace App\Http\Controllers;

use App\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kendaraans = Kendaraan::all();
        return view('kendaraan.index',compact('kendaraans'));
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
        $new = new Kendaraan();
        $new->nama_kendaraan = $request->get('nama_kendaraan');
        $new->komsumsi_bahan_bakar = $request->get('komsumsi_bahan_bakar');
        $new->jadwal_service = $request->get('jadwal_service');
        $new->save();
        return redirect()->route('kendaraan.index')->with('status', 'Berhasil Tambah Kendaraan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $kendaraan)
    {
        //
        $data= Kendaraan::find($kendaraan);
        $data->nama_kendaraan = $request->get('nama_kendaraan');
        $data->komsumsi_bahan_bakar = $request->get('komsumsi_bahan_bakar');
        $data->jadwal_service = $request->get('jadwal_service');
        $data->save();
        return redirect()->route('kendaraan.index')->with('status', 'Berhasil Update Kendaraan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        //
    }

    public function getEditForm(Request $request){
        $id=$request->get('id');
        $data= Kendaraan::find($id);
    
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('kendaraan.update',compact('data'))->render()
        ),200);
    }

}
