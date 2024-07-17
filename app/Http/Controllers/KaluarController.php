<?php

namespace App\Http\Controllers;

use App\Models\Kaluar;
use App\Models\Data;
use Illuminate\Http\Request;

class kaluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kaluar = kaluar::latest()->paginate(5);
        return view('kaluar.index', compact('kaluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Data::all();
        return view('kaluar.create', compact('data'));
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
        'jumlah' => 'required|min:1|max:1000',
        'tanggal_keluar' => 'required|date',
        'keterangan' => 'required',
        'id_data' => 'required',
    ]);

    // Create a new instance of kaluar
    $kaluar = new Kaluar();
    $kaluar->jumlah = $request->jumlah;
    $kaluar->tanggal_keluar = $request->tanggal_keluar;
    $kaluar->keterangan = $request->keterangan;
    $kaluar->id_data = $request->id_data;

    // Attempt to find the associated Data record
    $data = Data::findOrFail($request->id_data);

    // Check if Data record was found
    if ($data) {
        // Update stok in Data record
        $data->stok -= $request->jumlah;
        $data->save();

        // Save the kaluar record
        $kaluar->save();

        // Redirect to the index route of kaluar
        return redirect()->route('kaluar.index');
    } else {
        // Handle the case where Data record was not found
        // For example, you can redirect back with an error message
        return redirect()->back()->with('error', 'Data record not found');
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kaluar = kaluar::findOrFail($id);
        return view('kaluar.show', compact('kaluar'));
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
        $kaluar = kaluar::findOrFail($id);
        return view('kaluar.edit', compact('kaluar', 'data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jumlah' => 'required|required|min:1|max:1000',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'required',
        ]);

        $kaluar = kaluar::findOrFail($id);

        $data = Data::find($request->id_data);

        $kaluar->jumlah = $request->jumlah;
        $kaluar->tanggal_keluar = $request->tanggal_keluar;
        $kaluar->keterangan = $request->keterangan;
        $kaluar->id_data = $request->id_data;

        $data = Data::findOrFail($request->id_data);
        $data->stok += $request->jumlah;
        $data->save();

        $kaluar->save();
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
        $kaluar = kaluar::findOrFail($id);
        $kaluar->delete();
        return redirect()->route('kaluar.index');
    }
}
