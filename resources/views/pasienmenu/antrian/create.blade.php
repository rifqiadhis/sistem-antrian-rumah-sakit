@extends('layouts.pasien')

@section('title', 'Ambil Nomor Antrian')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Ambil Nomor Antrian Baru</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Pengambilan Antrian</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('pasien.antrian.store') }}" method="POST">
                @csrf
                {{-- ID Pasien tidak perlu diinput karena sudah login --}}
                <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">

                <div class="form-group mb-3">
                    <label><strong>Nama Pasien</strong></label>
                    <input type="text" class="form-control" value="{{ $pasien->nama }}" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="dokter_id" class="form-label"><strong>Pilih Dokter Tujuan</strong></label>
                    <select name="dokter_id" id="dokter_id" class="form-control" required>
                        <option value="">Pilih Dokter...</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->dokter_id }}">{{ $dokter->nama_dokter }} ({{ $dokter->spesialisasi }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Ambil Nomor</button>
                    <a href="{{ route('pasien.dashboard') }}" class="btn btn-secondary">Kembali ke Dasbor</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection