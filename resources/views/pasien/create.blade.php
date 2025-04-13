@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pasien</h1>
    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection