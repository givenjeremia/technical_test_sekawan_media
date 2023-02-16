<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $drivers = Driver::All();
        return view('driver.index',compact('drivers'));
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
        $new = new Driver();
        $new->nama_driver = $request->get("nama_driver");
        $new->keterangan = $request->get("keterangan");
        $status = $request->get("ready_status") ? $request->get("ready_status") : 0;
        $new->status = $status;
        $new->save();
        return redirect()->route('driver.index')->with('status', 'Berhasil Tambah Driver');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $driver)
    {
        //
        $data= Driver::find($driver);
        $data->nama_driver = $request->get("nama_driver");
        $data->keterangan = $request->get("keterangan");
        $status = $request->get("ready_status") ? $request->get("ready_status") : 0;
        $data->status = $status;
        $data->save();
        return redirect()->route('driver.index')->with('status', 'Berhasil Update Driver');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }

    public function getEditForm(Request $request){
        $id=$request->get('id');
        $data= Driver::find($id);
    
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('driver.update',compact('data'))->render()
        ),200);
    }

}
