@extends('layouts.app')
@section('title', 'Ubah Status Antrian')
@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Ubah Status Antrian</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Antrian No. {{ $antrian->nomor_antrian }} - Pasien: {{ $antrian->pasien->nama }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('antrian.update', $antrian->antrian_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="status" class="form-label"><strong>Status Antrian</strong></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Menunggu" @if($antrian->status == 'Menunggu') selected @endif>Menunggu</option>
                        <option value="Diproses" @if($antrian->status == 'Diproses') selected @endif>Diproses</option>
                        <option value="Selesai" @if($antrian->status == 'Selesai') selected @endif>Selesai</option>
                        <option value="Batal" @if($antrian->status == 'Batal') selected @endif>Batal</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection