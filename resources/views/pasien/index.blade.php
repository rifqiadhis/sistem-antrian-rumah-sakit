@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('content')
<div>
    <div class="row mb-3 align-items-center">
        <div class="col">
            <h1 class="h3 text-gray-800 mb-0">Daftar Pasien</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
        </div>
    </div>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pasien as $p)
                <tr>
                    <td>{{ $pasien->firstItem() + $loop->index }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->nomor_telepon }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->tanggal_lahir }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>
                        <a href="{{ route('pasien.show', $p->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('pasien.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pasien.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Data Pasien belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {!! $pasien->links() !!}
    </div>
</div>
@endsection