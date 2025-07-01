@extends('layouts.app')

@section('title', 'Tambah Dokter')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Tambah Dokter Baru</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Dokter</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokter.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" value="{{ old('nama_dokter') }}" required>
                </div>
                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi</label>
                    <input type="text" name="spesialisasi" id="spesialisasi" class="form-control" value="{{ old('spesialisasi') }}" required>
                </div>
                <div class="form-group">
                    <label for="kontak">Kontak</label>
                    <input type="text" name="kontak" id="kontak" class="form-control" value="{{ old('kontak') }}" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection