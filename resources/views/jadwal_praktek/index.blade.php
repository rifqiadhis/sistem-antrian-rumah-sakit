@extends('layouts.app')
@section('title', 'Jadwal Praktek')
@section('content')
<div>
    <div class="row mb-3 align-items-center">
        <div class="col"><h1 class="h3 text-gray-800 mb-0">Jadwal Praktek Dokter</h1></div>
        <div class="col-auto"><a href="{{ route('jadwal-praktek.create') }}" class="btn btn-primary">Tambah Jadwal</a></div>
    </div>
    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Jam Praktek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalPrakteks as $jadwal)
                <tr>
                    <td>{{ $jadwalPrakteks->firstItem() + $loop->index }}</td>
                    <td>{{ $jadwal->dokter->nama_dokter }}</td>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                    <td>
                        <a href="{{ route('jadwal-praktek.show', $jadwal->jadwal_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('jadwal-praktek.edit', $jadwal->jadwal_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jadwal-praktek.destroy', $jadwal->jadwal_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Data Jadwal Praktek belum tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{!! $jadwalPrakteks->links() !!}</div>
</div>
@endsection