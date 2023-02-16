<?php

namespace App\Http\Controllers;

use App\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $pemakaians = Kendaraan::join('penyewaan', 'kendaraan.id', '=', 'penyewaan.kendaraan_id')
        ->selectRaw('kendaraan.*, count(penyewaan.kendaraan_id) as pemakaian')
        ->groupBy('kendaraan.id')
        ->get();
  
        // dd($pemakaians);
        return view('layouts.dashboard',compact('pemakaians'));
    }
}
