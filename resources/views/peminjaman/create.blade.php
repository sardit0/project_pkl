@extends('layouts.backend')
@section('content')
<div class="col-12 col-xl-12">
    <div class="card m-3">
        <div class="card-body p-4">
            <h5 class="mb-4">Peminjaman</h5>
            <form class="row g-3" method="POST" action="{{ route('peminjaman.store') }}">
                @csrf
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
                <div class="col-md-12">
                    <label for="input17" class="form-label">jumlah Barang</label>
                    <div class="position-relative input-icon">
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="input17" placeholder="Stock">
                        <span class="position-absolute top-50 translate-middle-y"></span>
                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="input17" class="form-label">Tanggal Pinjam</label>
                    <div class="position-relative input-icon">
                        <input type="date" name="tanggal_minjem" class="form-control" id="input17">
                        <span class="position-absolute top-50 translate-middle-y"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="input17" class="form-label">Nama Peminjam</label>
                    <div class="position-relative input-icon">
                        <input type="text" name="nama" class="form-control" id="input17">
                        <span class="position-absolute top-50 translate-middle-y"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword4">Status</label>
                    <select name="status" class="form-control" id="" style="color: #ffffff;">
                        <option value="Sedang Diminjem">Sedang Diminjem</option>
                        <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-success px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection