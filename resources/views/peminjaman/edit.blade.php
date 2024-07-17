@extends('layouts.backend')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Data</h4>

            <form action="{{ route('peminjaman.update', $minjem->id) }}" method="POST" enctype="multipart/form-data"
                class="forms-sample">
                @csrf
                @method('PUT')
                <div class="mb-3">  
                    <label for="nama" class="form-label">Nama Barang</label>
                    <select name="id_data" id="nama" class="form-control">
                        <option disabled selected ="">Isi Disini</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            {{-- @empty --}}
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="merek" class="form-label">Nama Merek</label>
                    <select name="id_data" id="merek" class="form-control">
                        <option disabled selected ="">Isi Disini</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->merek }}</option>
                            {{-- @empty --}}
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Jumlah</label>
                    <input type="number" class="form-control" id="exampleInputEmail3" placeholder="Jumlah" name="jumlah"
                        value="{{ $minjem->jumlah }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Tanggal Minjem</label>
                    <input type="date" class="form-control" id="exampleInputPassword4" placeholder="Stok"
                        name="tanggal_minjem" value="{{ $minjem->tanggal_minjem }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Nama Peminjam</label>
                    <input type="text" class="form-control" id="exampleInputPassword4" placeholder="Stok"
                        name="nama" value="{{ $minjem->nama_peminjam }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Status</label>
                    <select name="status" class="form-control" id="" value="{{ $minjem->status }}" style="color: #000000;">
                        <option value="Sedang Diminjem">Sedang Diminjem</option>
                        <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-dark">Cancel</a>
            </form>
        </div>
    </div>
@endsection