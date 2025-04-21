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
    <div class="card">

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
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
            @foreach($pasien as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->nomor_telepon }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->tanggal_lahir }}</td>
                <td>{{ $p->jenis_kelamin }}</td>
                <td>
                    <a href="{{ route('pasien.show', $p->id) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('pasien.edit', $p->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pasien.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
