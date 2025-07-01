@extends('layouts.pasien')

@section('title', 'Edit Profil Saya')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Edit Profil Saya</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pribadi</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('pasien.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="text-center mb-3">
                    <img src="{{ $pasien->foto_profil ? asset('storage/' . $pasien->foto_profil) : asset('img/undraw_profile.svg') }}"
                        alt="Foto Profil" class="img-profile rounded-circle"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                <div class="form-group mb-3">
                    <label for="foto_profil"><strong>Ubah Foto Profil</strong></label>
                    <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto. (Maks: 2MB)</small>
                </div>

                <hr>

                <div class="form-group mb-3">
                    <label><strong>Nomor WhatsApp (Tidak bisa diubah)</strong></label>
                    <input type="text" class="form-control" value="{{ $pasien->nomor_telepon }}" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="nama"><strong>Nama Lengkap</strong></label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ old('nama', $pasien->nama) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat"><strong>Alamat</strong></label>
                    <textarea name="alamat" id="alamat" class="form-control"
                        required>{{ old('alamat', $pasien->alamat) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $pasien->email) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="tanggal_lahir"><strong>Tanggal Lahir</strong></label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $pasien->tanggal_lahir ? $pasien->tanggal_lahir->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="jenis_kelamin"><strong>Jenis Kelamin</strong></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="Laki-laki" @if(old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki') selected @endif>Laki-laki</option>
                                <option value="Perempuan" @if(old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan') selected @endif>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('pasien.dashboard') }}" class="btn btn-secondary">Kembali ke Dasbor</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection