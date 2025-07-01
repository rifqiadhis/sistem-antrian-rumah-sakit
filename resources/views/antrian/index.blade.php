@extends('layouts.app')
@section('title', 'Daftar Antrian')
@section('content')
<div>
    <div class="row mb-3 align-items-center">
        <div class="col"><h1 class="h3 text-gray-800 mb-0">Daftar Antrian Pasien</h1></div>
        <div class="col-auto"><a href="{{ route('antrian.create') }}" class="btn btn-primary">Ambil Antrian Baru</a></div>
    </div>
    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Antrian</th>
                    <th>Nama Pasien</th>
                    <th>Dokter Tujuan</th>
                    <th>Waktu Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($antrians as $antrian)
                <tr>
                    <td>{{ $antrians->firstItem() + $loop->index }}</td>
                    <td>{{ $antrian->nomor_antrian }}</td>
                    <td>{{ $antrian->pasien->nama }}</td>
                    <td>{{ $antrian->dokter->nama_dokter }}</td>
                    <td>{{ $antrian->created_at->format('d M Y, H:i') }}</td>
                    <td>{{ $antrian->status }}</td>
                    <td>
                        <a href="{{ route('antrian.edit', $antrian->antrian_id) }}" class="btn btn-warning btn-sm">Ubah Status</a>
                        <form action="{{ route('antrian.destroy', $antrian->antrian_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">Belum ada antrian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{!! $antrians->links() !!}</div>
</div>
@endsection