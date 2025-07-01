@extends('layouts.app')
@section('title', 'Ambil Nomor Antrian')
@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Ambil Nomor Antrian Baru</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Formulir Pengambilan Antrian</h6></div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('antrian.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="pasien_id" class="form-label"><strong>Nama Pasien</strong></label>
                    <select name="pasien_id" id="pasien_id" class="form-control" required>
                        <option value="">Pilih Pasien</option>
                        @foreach ($pasiens as $pasien)
                            <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="dokter_id" class="form-label"><strong>Dokter Tujuan</strong></label>
                    <select name="dokter_id" id="dokter_id" class="form-control" required>
                        <option value="">Pilih Dokter</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->dokter_id }}">{{ $dokter->nama_dokter }} ({{ $dokter->spesialisasi }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Ambil Nomor</button>
                    <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection