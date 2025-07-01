@extends('layouts.app')

@section('title', 'Detail Dokter')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Detail Dokter</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $dokter->nama_dokter }}</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <strong>ID Dokter:</strong>
                <p>{{ $dokter->dokter_id }}</p>
            </div>
            <div class="mb-3">
                <strong>Spesialisasi:</strong>
                <p>{{ $dokter->spesialisasi }}</p>
            </div>
            <div class="mb-3">
                <strong>Kontak:</strong>
                <p>{{ $dokter->kontak }}</p>
            </div>
            <div class="mb-3">
                <strong>Data Dibuat Pada:</strong>
                <p>{{ $dokter->created_at->format('d M Y, H:i:s') }}</p>
            </div>
             <div class="mb-3">
                <strong>Data Diperbarui Pada:</strong>
                <p>{{ $dokter->updated_at->format('d M Y, H:i:s') }}</p>
            </div>
            
            <hr>

            <a href="{{ route('dokter.edit', $dokter->dokter_id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('dokter.destroy', $dokter->dokter_id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
            </form>
            <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection