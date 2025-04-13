@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pasien</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pasien->nama }}</h5>
            <p class="card-text"><strong>Alamat:</strong> {{ $pasien->alamat }}</p>
            <p class="card-text"><strong>Nomor Telepon:</strong> {{ $pasien->nomor_telepon }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $pasien->email }}</p>
            <p class="card-text"><strong>Tanggal Lahir:</strong> {{ $pasien->tanggal_lahir }}</p>
            <p class="card-text"><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</p>
            <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
