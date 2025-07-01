@extends('layouts.pasien')

@section('title', 'Dasbor Saya')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Antrian Anda Hari Ini</h6>
            </div>
            <div class="card-body">
                @if ($antrianHariIni)
                    {{-- Jika pasien sudah punya antrian hari ini --}}
                    <h4 class="font-weight-bold">Nomor Antrian Anda: {{ $antrianHariIni->nomor_antrian }}</h4>
                    <p>Untuk: <strong>Dr. {{ $antrianHariIni->dokter->nama_dokter }}</strong></p>
                    <hr>
                    <p>Sisa antrian di depan Anda:</p>
                    <h1 class="display-4 font-weight-bold text-center">{{ $sisaAntrian }}</h1>
                    @if ($sisaAntrian == 0)
                        <div class="alert alert-success text-center" role="alert">
                            <strong>Sekarang giliran Anda!</strong>
                        </div>
                    @endif
                @else
                    {{-- Jika pasien belum punya antrian hari ini --}}
                    <p>Anda belum memiliki nomor antrian untuk hari ini.</p>
                    <a href="{{ route('pasien.antrian.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-ticket-alt fa-fw"></i> Ambil Nomor Antrian Sekarang
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Antrian Saya</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Dokter</th>
                        <th>No. Antrian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatAntrian as $antrian)
                        <tr>
                            <td>{{ $riwayatAntrian->firstItem() + $loop->index }}</td>
                            <td>{{ $antrian->created_at->format('d M Y') }}</td>
                            <td>{{ $antrian->dokter->nama_dokter }}</td>
                            <td>{{ $antrian->nomor_antrian }}</td>
                            <td>{{ $antrian->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Anda belum memiliki riwayat antrian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {!! $riwayatAntrian->links() !!}
        </div>
    </div>
</div>

@endsection