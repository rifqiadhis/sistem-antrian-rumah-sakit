@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Detail Jadwal Praktek</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal untuk {{ $jadwalPraktek->dokter->nama_dokter }}</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>Nama Dokter:</strong>
                <p>{{ $jadwalPraktek->dokter->nama_dokter }}</p>
            </div>
            <div class="mb-3">
                <strong>Spesialisasi:</strong>
                <p>{{ $jadwalPraktek->dokter->spesialisasi }}</p>
            </div>
            <div class="mb-3">
                <strong>Hari Praktek:</strong>
                <p>{{ $jadwalPraktek->hari }}</p>
            </div>
            <div class="mb-3">
                <strong>Jam Praktek:</strong>
                <p>{{ substr($jadwalPraktek->jam_mulai, 0, 5) }} - {{ substr($jadwalPraktek->jam_selesai, 0, 5) }}</p>
            </div>
             <div class="mb-3">
                <strong>Data Dibuat Pada:</strong>
                <p>{{ $jadwalPraktek->created_at->format('d M Y, H:i:s') }}</p>
            </div>
            <hr>
            <a href="{{ route('jadwal-praktek.edit', $jadwalPraktek->jadwal_id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('jadwal-praktek.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection