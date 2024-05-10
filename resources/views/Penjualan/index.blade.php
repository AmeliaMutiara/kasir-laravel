@extends('base')

@if (Auth::user()->level == 'admin')
    @section('title', 'Laporan')

    @section('content_header')
        <h1>Daftar Laporan Penjualan</h1>
    @stop
@endif

@section('title', 'Penjualan')

@section('content_header')
    <h1>Daftar Penjualan</h1>
@stop

@section('content')
    @if (Auth::user()->level == 'admin')
        <div id="accordion">
            <form action="{{ route('sales.filter') }}" method="post">
                @csrf
                <div class="card border border-dark">
                    <div class="card-header bg-dark" data-toggle="collapse" data-target="#collapseOne" >
                        <h5>
                            Filter
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                            Tanggal Mulai
                                            <span class="text-danger">
                                                *
                                            </span>
                                        <input type="date" name="start_date" required class="col-8 form-control" value="{{ $filter['start_date'] ?? date('Y-m-d') }}" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                            Tanggal Mulai
                                            <span class="text-danger">
                                                *
                                            </span>
                                        <input type="date" name="end_date" required class="col-8 form-control" value="{{ $filter['end_date'] ?? date('Y-m-d') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a href="{{ route('sales.filter-reset') }}" class="btn btn-sm btn-danger" type="reset"><i class="fa fa-times fa-sm"></i> Batal</a>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
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
        <div class="card-header bg-dark">
            <h5>
                Daftar
            </h5>
            @if (Auth::user()->level == 'kasir')
            <div class="form-actions float-right">
                <a href="{{ route('sales.add') }}" name="Find" class="btn btn-sm btn-primary" title="Add Data">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="text-center">
                        <th >No.</th>
                        <th>Tanggal Penjualan</th>
                        <th>Kode Penjualan</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Penjualan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr class="text-center">
                                <td >{{ $no++ }}</td>
                                <td>{{ $item->tglPenjualan }}</td>
                                <td>{{ $item->kodePenjualan }}</td>
                                <td>{{ $item->pelanggan->namaPelanggan ?? '-' }}</td>
                                <td>{{ number_format($item->totalHarga,2) }}</td>
                                <td>
                                    <a type="button" href="{{ route('sales.detail', $item->id) }}" class="btn btn-sm mb-1 me-1 btn-warning btn-active-light-warning">
                                        Detail
                                    </a>
                                    @if (Auth::user()->level == 'kasir')
                                    <a type="button" href="{{ route('sales.print-struk', $item->id) }}" class="btn btn-sm mb-1 me-1 btn-secondary btn-active-light-secondary">
                                        Print
                                    </a>
                                    <a type="button" href="{{ route('sales.delete', $item->id) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-sm mb-1 me-1 btn-danger btn-active-light-danger">
                                        Hapus
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop