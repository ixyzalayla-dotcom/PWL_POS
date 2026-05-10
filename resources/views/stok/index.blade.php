@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>User Penginput</th>
                    <th>Stok Tanggal</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataStok = $('#table_stok').DataTable({
            serverSide: true, 
            ajax: {
                "url": "{{ url('stok/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                {
                    data: "DT_RowIndex", 
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },{
                    data: "barang.barang_nama",           
                    className: "",
                    orderable: true,    
                    searchable: true    
                },{
                    data: "user.nama",     
                    className: "",
                    orderable: true,    
                    searchable: true    
                },{
                    data: "stok_tanggal",           
                    className: "",
                    orderable: true,    
                    searchable: true    
                },{
                    data: "stok_jumlah",           
                    className: "",
                    orderable: true,    
                    searchable: true    
                },{
                    data: "aksi",               
                    className: "",
                    orderable: false,    
                    searchable: false    
                }
            ]
        });
    });
</script>
@endpush