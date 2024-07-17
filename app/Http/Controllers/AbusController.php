<?php

namespace App\Http\Controllers;

use App\Models\Abus;
use App\Models\Data;
use Illuminate\Http\Request;

class AbusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abus = Abus::latest()->paginate(5);
        return view('abus.index', compact('abus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Data::all();
        return view('abus.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'jumlah' => 'required|min:1|max:1000',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'required',
            'id_data' => 'required',
        ]);
        

        $abus = new abus();

        $abus->jumlah = $request->jumlah;
        $abus->tanggal_masuk = $request->tanggal_masuk;
        $abus->keterangan = $request->keterangan;
        $abus->id_data = $request->id_data;

        $data = Data::findOrFail($request->id_data);
        $data->stok += $request->jumlah;
        $data->save();

        $abus->save();
        return redirect()->route('abus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $abus = abus::findOrFail($id);
        return view('abus.show', compact('abus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = data::all();
        $abus = abus::findOrFail($id);
        return view('abus.edit', compact('abus', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jumlah' => 'required|min:1|max:1000',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'required',
            'id_data' => 'required',
        ]);

        $abus = abus::findOrFail($id);

        $data = Data::find($request->id_data);

        $abus->jumlah = $request->jumlah;
        $abus->tanggal_masuk = $request->tanggal_masuk;
        $abus->keterangan = $request->keterangan;
        $abus->id_data = $request->id_data;

        $data = Data::findOrFail($request->id_data);
        $data->stok += $request->jumlah;
        $data->save();

        $abus->save();
        return redirect()->route('abus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $abus = abus::findOrFail($id);
        $abus->delete();
        return redirect()->route('abus.index');
    }
}
