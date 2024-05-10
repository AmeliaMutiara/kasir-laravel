@extends('base')

@section('title', 'Produk')

@section('content_header')
    <h1>Daftar Produk</h1>
@stop

@section('content')
    @if (session('msg'))
        <div class="alert alert-{{ session('type') ?? 'info' }}" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $e)
                {{ $e }}
            @endforeach
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            @if (Auth::user()->level == 'admin')
            <div class="form-actions float-right">
                <a href="{{ route('product.add') }}" name="Find" class="btn btn-sm btn-primary" title="Add Data">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <th class="text-center">No.</th>
                        <th class="text-center">Kode Produk</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga Produk</th>
                        <th class="text-center">Stok Produk</th>
                        @if (Auth::user()->level == 'admin')
                        <th class="text-center">Aksi</th>
                        @endif
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $item->kodeProduk }}</td>
                                <td class="text-center">{{ $item->namaProduk }}</td>
                                <td class="text-center">{{ number_format($item->harga,2) }}</td>
                                <td class="text-center">{{ $item->stok }}</td>
                                @if (Auth::user()->level == 'admin')
                                <td class="text-center">
                                    <a type="button" href="{{ route('product.edit', $item->id) }}" class="btn btn-sm mb-1 me-1 btn-warning btn-active-light-warning">
                                        Edit
                                    </a>
                                    <a type="button" href="{{ route('product.delete', $item->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-sm mb-1 me-1 btn-danger btn-active-light-danger">
                                        Hapus
                                    </a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('table').dataTable();
        });
    </script>
@stop

@section('footer')
<strong>Copyright &copy; UKK2024 <a href="https://www.instagram.com/onlyra_ia">AmeliaMutiara</a>.</strong>
All rights reserved.
@stop