@extends('base')

@section('title', 'Pelanggan')

@section('content_header')
    <h1>Edit Pelanggan</h1>
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
                Edit
            </h5>
            <div class="form-actions float-right">
                <a href="{{ route('customer.index') }}" name="Find" class="btn btn-sm btn-primary" title="Back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <form action="{{ route('customer.edit-process') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="row">
                    <input name="id" value="{{ $data->id }}" type="hidden">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <input name="namaPelanggan" value="{{ $data->namaPelanggan }}" class="form-control" rows="6" placeholder="Masukkan Nama Pelanggan">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input name="noTelp" value="{{ $data->noTelp }}" class="form-control" rows="6" placeholder="Masukkan Nomor Telepon">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat...">{{ $data->alamat }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success" onclick="$(this).addClass('disabled');$('form').submit();">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
@stop

@section('footer')
<strong>Copyright &copy; UKK2024 <a href="https://www.instagram.com/onlyra_ia">AmeliaMutiara</a>.</strong>
All rights reserved.
@stop