@extends('layouts.backend')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@endsection
@section('content')
<h6 class="mb-0 text-uppercase"></h6>
<hr>
<div class="card m-3">
    <div class="card-body">
        <div class="col-lg-2">
            <a href="{{ route('abus.create') }}" class="btn btn-success px-4 raised d-flex gap-2">
                <i class="material-icons-outlined"></i>
                Add Barang
            </a>
        </div>
        <table class="table mb-0 table-striped" id="example">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Merek</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abus as $data)
                <tr>
                    <th scope="row">{{ $loop->index+1 }}</th>
                    <td>{{ $data->data->nama }}</td>
                    <td>{{ $data->data->merek }}</td>
                    <td>{{ $data->jumlah }}</td>
                    <td>{{ $data->tanggal_masuk }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>
                        <a href="{{ route('abus.edit', $data->id) }}" class="btn btn-grd-warning px-2">Edit</a>
                        <a class="btn ripple btn-grd-danger px-3" href="#" onclick="event.preventDefault();
                            document.getElementById('destroy-form').submit();">
                            Hapus
                        </a>

                        <form id="destroy-form" action="{{ route('abus.destroy', $data->id) }}"
                            method="POST" class="d-none">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script>
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: ['pdf', 'excel']
            }
        }
    });
</script>

@endpush