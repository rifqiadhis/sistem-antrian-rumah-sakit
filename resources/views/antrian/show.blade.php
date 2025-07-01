@extends('layouts.app')

@section('title', 'Detail Antrian')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Detail Antrian</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Antrian No. {{ $antrian->nomor_antrian }} untuk Dokter {{ $antrian->dokter->nama_dokter }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Pasien</h5>
                    <hr>
                    <div class="mb-2">
                        <strong>Nama:</strong>
                        <p>{{ $antrian->pasien->nama }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Email:</strong>
                        <p>{{ $antrian->pasien->email }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Nomor Telepon:</strong>
                        <p>{{ $antrian->pasien->nomor_telepon }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h5>Data Antrian</h5>
                    <hr>
                    <div class="mb-2">
                        <strong>Dokter Tujuan:</strong>
                        <p>{{ $antrian->dokter->nama_dokter }} ({{ $antrian->dokter->spesialisasi }})</p>
                    </div>
                    <div class="mb-2">
                        <strong>Status Antrian:</strong>
                        <p>{{ $antrian->status }}</p>
                    </div>
                    <div class="mb-2">
                        <strong>Waktu Daftar:</strong>
                        <p>{{ $antrian->created_at->format('d M Y, H:i:s') }}</p>
                    </div>
                </div>
            </div>
            
            <hr>

            <a href="{{ route('antrian.edit', $antrian->antrian_id) }}" class="btn btn-warning">Ubah Status</a>
            <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali ke Daftar Antrian</a>
        </div>
    </div>
</div>
@endsection