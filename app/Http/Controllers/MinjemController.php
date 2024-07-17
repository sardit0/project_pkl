<?php

namespace App\Http\Controllers;

use App\Models\Minjem;
use App\Models\Kembali;
use App\Models\Data;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MinjemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minjem = minjem::latest()->paginate(5);
        return view('peminjaman.index', compact('minjem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Data::all();
        $minjem = Minjem::all();
        $kembali = Kembali::all();
        return view('peminjaman.create', compact('minjem','data','kembali'));
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
            'tanggal_minjem' => 'required|date',
            'nama' => 'required',
            'status' => 'required',
            'id_data' => 'required',
        ]);

        // Create a new instance of minjem
        $minjem = new minjem();
        $minjem->jumlah = $request->jumlah;
        $minjem->tanggal_minjem = $request->tanggal_minjem;
        $minjem->nama = $request->nama;
        $minjem->status = $request->status;
        $minjem->id_data = $request->id_data;

        // Attempt to find the associated Data record
        $data = Data::findOrFail($request->id_data);

        // Check if Data record was found
        if ($data) {
            // Update stok in Data record
            $data->stok -= $request->jumlah;
            $data->save();

            // Save the minjem record
            $minjem->save();

            // Redirect to the index route of minjem
            return redirect()->route('peminjaman.index');
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
        $minjem = minjem::findOrFail($id);
        return view('peminjaman.show', compact('minjem'));
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
        $minjem = minjem::findOrFail($id);
        return view('peminjaman.edit', compact('minjem','data'));
    }

    public function update(Request $request, $id)
    {
        $minjem = minjem::findOrFail($id);
        $data = data::findOrFail($minjem->id_data);

        $minjem->update($request->all());

        if ($data->stok < $request->jumlah) {
            Alert::warning('Warning', 'Stok Tidak Cukup')->autoClose(1500);
            return redirect()->route('peminjaman.index');
        } else {
            $data->stok += $minjem->jumlah;
            $data->stok -= $request->jumlah;
            $data->save();
        }

        if ($request->status == "Sudah Dikembalikan") {
            $data->stok += $minjem->jumlah;
            $data->save();
        }
        $minjem->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoclose(1500);
        return redirect()->route('peminjaman.index');
    }
    public function destroy($id)
    {
        $minjem = minjem::findOrFail($id);
        $minjem->delete();
        return redirect()->route('peminjaman.index');
    }
}
