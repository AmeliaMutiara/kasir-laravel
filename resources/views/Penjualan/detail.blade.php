@extends('base')

@if (Auth::user()->level == 'admin')
    @section('title', 'Laporan')

    @section('content_header')
        <h1>Detail Laporan Penjualan</h1>
    @stop
@endif

@section('title', 'Penjualan')

@section('content_header')
    <h1>Detail Penjualan</h1>
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
            <div class="form-actions float-right">
                <a href="{{ route('sales.index') }}" name="Find" class="btn btn-sm btn-primary" title="Back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga Produk</th>
                        <th class="text-center">Jumlah Produk</th>
                        <th class="text-center">Subtotal</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $total = 0;
                            $kembalian = 0;
                        @endphp
                        @if (empty($penjualan->detail))
                            <tr>
                                <td colspan="6" class="text-center">Data Kosong</td>
                            </tr>
                        @else
                            @foreach ($penjualan->detail as $k => $v)
                                <tr>
                                    <td class="text-center">{{ $no++; }}</td>
                                    <td>{{ $v->produk->namaProduk }}</td>
                                    <td class="text-right">{{ number_format($v->produk->harga,2) }}</td>
                                    <td class="text-center">{{ $v->jmlProduk }}</td>
                                    <td class="text-right">{{ number_format($v->subtotal,2) }}</td>
                                </tr>
                                @php
                                    $total += ($v->subtotal);
                                @endphp
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">Total</td>
                            <td colspan="2" class="text-right">{{ number_format($total,2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="card border border-dark">
        <div class="card-body">
                <div class="row">
                        @php
                            $bayar = $penjualan->bayar;
                            $kembalian = $penjualan->bayar-$total;
                        @endphp
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Penjualan</label>
                                <input name="tglPenjualan" value="{{ date('d-m-Y', strtotime($penjualan->tglPenjualan)) }}" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nominal Bayar</label>
                                <input name="bayar" value="{{ number_format($bayar,2) }}" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Penjualan</label>
                                <input name="kodePenjualan" value="{{ $penjualan->kodePenjualan }}" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nominal Kembalian</label>
                                <input name="sisa" value="{{ number_format($kembalian,2) }}" disabled class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input name="namaPelanggan" value="{{ $penjualan->pelanggan->namaPelanggan ?? '-' }}" disabled class="form-control" />
                            </div>
                        </div>
                </div>
            </div>
    </div>
@stop

@section('js')
    <script>
        var totalHargaInput = document.getElementById('totalHarga');
        var bayarInput = document.getElementById('bayar');
        var sisaInput = document.getElementById('sisa');

        function hitungKembalian() {
            var totalHarga = parseFloat(totalHargaInput.value);
            var bayar = parseFloat(bayarInput.value);

            var kembalian = bayar - totalHarga;

            kembalian = kembalian < 0 ? 0 : kembalian;

            sisaInput.value = kembalian;
        }

        bayarInput.addEventListener('input', hitungKembalian);

        function deleteItem(id) {
            if (confirm('Apakah anda yakin ingin menghapus produk ini?')) {
                location.href = '{{ route("sales.delete-item") }}' + '/' + id;
            }
        }
    </script>
@stop

@section('footer')
<strong>Copyright &copy; UKK2024 <a href="https://www.instagram.com/onlyra_ia">AmeliaMutiara</a>.</strong>
All rights reserved.
@stop