<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kaluar;
use App\Models\Abus;
use App\Models\Data;
use App\Models\Minjem;
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
        $data = Data::count('id');
        $abus = Abus::count('id');
        $kaluar = Kaluar::count('id');
        $minjem = Minjem::count('id');
        $kembali = Minjem::where('status', 'Sudah Dikembalikan')->count('id');
        return view('home', compact('data', 'abus', 'kaluar', 'minjem', 'kembali'));
    }
}
