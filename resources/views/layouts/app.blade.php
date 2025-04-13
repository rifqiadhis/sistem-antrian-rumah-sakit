<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    <!-- Tambahkan link CSS Bootstrap atau stylesheet lainnya di sini -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Aplikasi Kesehatan</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('pasien.index') }}">Pasien</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('dokter.index') }}">Dokter</a></li>
            <!-- Tambahkan menu lain sesuai kebutuhan -->
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Tambahkan script JS Bootstrap atau script lainnya di sini -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>