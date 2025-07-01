@extends('layouts.auth')

@section('title', 'Registrasi Pasien')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header text-center"><h3>Registrasi Pasien Baru</h3></div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                    </div>
                     <div class="form-group mb-2">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" required>{{ old('alamat') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group mb-2">
                                <label for="nomor_telepon">Nomor WhatsApp</label>
                                <input type="text" class="form-control" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Contoh: 62812xxxx" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group mb-2">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">Pilih...</option>
                                    <option value="Laki-laki" @if(old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki</option>
                                    <option value="Perempuan" @if(old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>
                <div class="text-center mt-3">
                    <a class="small" href="{{ route('login') }}">Sudah punya akun? Login di sini!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection