<?php

namespace App\Http\Controllers;

use App\User;
use App\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PersetujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_login = Auth::user();
        $user = User::find($user_login->id);
        $data = $user->penyewaan()->get();
        return view('penyewaan.persetujuan',compact('data'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $user_login = Auth::user();
        $id = $request->get('id');
        $fnama = $request->get('fnama');
        $value = $request->get('value');
        
        // dd($fnama);
        $penyewaan = Penyewaan::find($id);
        $penyewaan->persetujuan()->updateExistingPivot($user_login->id,[
                'tanggal_setuju' =>Carbon::now()->toDateString(),'status' => $value
            ]);
        // dd($penyewaan);
        // $NotaPemesanan->$fnama = $value;
        $penyewaan->save();
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => 'Status Penyewaan Berhasil Di Update'
            ),
            200
        );
    }
}
