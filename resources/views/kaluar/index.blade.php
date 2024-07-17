@extends('layouts.backend')
@section('content')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@endsection
<h6 class="mb-0 text-uppercase"></h6>
<hr>
<div class="card m-3">
    <div class="card-body">
        <div class="col-lg-2">
            <a href="{{ route('kaluar.create') }}" class="btn btn-success px-4 raised d-flex gap-2">
                <i class="material-icons-outlined"></i>
                Barang Keluar
            </a>
        </div>
        <table class="table mb-0 table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Merek</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal Keluar</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kaluar as $item)
                <tr>
                    <th scope="row">{{ $loop->index+1 }}</th>
                    <td>{{ $item->data->nama }}</td>
                    <td>{{ $item->data->merek }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tanggal_keluar }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                        <a href="{{ route('kaluar.edit', $item->id) }}" class="btn btn-grd-warning px-2">Edit</a>
                        <a class="btn ripple btn-grd-danger px-3" href="#" onclick="event.preventDefault();
                            document.getElementById('destroy-form').submit();">
                            Hapus
                        </a>

                        <form id="destroy-form" action="{{ route('kaluar.destroy', $item->id) }}"
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