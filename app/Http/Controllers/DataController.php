<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Abus;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abus = abus::all();
        $data = data::latest()->get();
        return view ('data.index', compact('data','abus'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $abus = abus::all();
        return view('data.create', compact('abus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'nama' => 'required',
        'merek' => 'required',
        'stok' => 'nullable|min:0',
    ]);


    $data = new Data();
    $data->nama = $request->nama;
    $data->merek = $request->merek;
    $data->stok = $request->stok;

    $data->save();

    return redirect()->route('data.index')->with('success', 'Data berhasil disimpan.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Data::findOrFail($id);
        return view ('data.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Data::findeOrFail($id);
        return view('data.edit', compsct('data'));
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
        $this->validate($request, [
            'nama' => 'required',
            'merek' => 'required',
            'stok' => 'required|min:1',
        ]);

        $data = data::findOrFail($id);
        $data->nama = $request->nama;
        $data->merek = $request->merek;
        $data->stok = $request->stok;
        $data->save();
        return redirect()->route('data.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = data::findOrFail($id);
        $data->delete();
        return redirect()->route('data.index');
    }
}
