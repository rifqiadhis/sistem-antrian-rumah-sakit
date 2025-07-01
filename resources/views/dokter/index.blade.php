@extends('layouts.app')

@section('title', 'Daftar Dokter')

@section('content')
<div>
    <div class="row mb-3 align-items-center">
        <div class="col">
            <h1 class="h3 text-gray-800 mb-0">Daftar Dokter</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('dokter.create') }}" class="btn btn-primary">Tambah Dokter</a>
        </div>
    </div>

    {{-- Notifikasi Sukses atau Error --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
         <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokters as $dokter)
                <tr>
                    <td>{{ $dokters->firstItem() + $loop->index }}</td>
                    <td>{{ $dokter->nama_dokter }}</td>
                    <td>{{ $dokter->spesialisasi }}</td>
                    <td>{{ $dokter->kontak }}</td>
                    <td>
                        <a href="{{ route('dokter.show', $dokter->dokter_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('dokter.edit', $dokter->dokter_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dokter.destroy', $dokter->dokter_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data Dokter belum tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination Links --}}
    <div class="mt-3">
        {!! $dokters->links() !!}
    </div>
</div>
@endsection