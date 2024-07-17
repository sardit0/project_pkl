@extends('layouts.backend')
@section('content')
<div class="col-12 col-xl-12">
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Barang {{ $data->nama }}</h5>
            <form class="row g-3" method="POST" action="{{ route('data.update', $data->id) }}">
                @method('PATCH')
                @csrf
                <div class="col-md-4x">
                    <label for="input13" class="form-label">Nama</label>
                    <div class="position-relative input-icon">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="input13" value="{{ $abus->nama }}" placeholder="Full nama" required>
                        <span class="position-absolute top-50 translate-middle-y"></span>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="input16" class="form-label">Merek</label>
                    <div class="position-relative input-icon">
                        <input type="text" name="merek" class="form-control @error('merek') is-invalid @enderror" value="{{ $abus->merek }}" id="input16" placeholder="merek" required>
                        <span class="position-absolute top-50 translate-middle-y"></span>
                        @error('merek')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="input17" class="form-label">Stock</label>
                    <div class="position-relative input-icon">
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" id="input17" placeholder="stok">
                        <span class="position-absolute top-50 translate-middle-y"></span>
                        @error('stok')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection