@extends('layouts.auth')
@section('title', 'Verifikasi OTP')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header text-center"><h3>Masukkan Kode OTP</h3></div>
            <div class="card-body">
                @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if (session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                <form method="POST" action="{{ route('login.otp') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="otp">Kode OTP</label>
                        <input type="text" class="form-control" name="otp" required autofocus placeholder="Masukkan 6 digit kode">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Verifikasi & Login</button>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">Salah nomor? Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection