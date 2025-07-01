@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header text-center"><h3>Login Sistem</h3></div>
            <div class="card-body">
                @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="phone_number">Nomor WhatsApp</label>
                        <input type="text" class="form-control" name="phone_number" required autofocus placeholder="Contoh: 6281234567890">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim Kode OTP</button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Belum punya akun? Daftar sebagai Pasien!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection