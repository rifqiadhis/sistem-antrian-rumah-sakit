@extends('layouts.app')

@section('title', 'Edit Jadwal Praktek')

@section('content')
<div>
    <h1 class="h3 mb-4 text-gray-800">Edit Jadwal</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Jadwal</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jadwal-praktek.update', $jadwalPraktek->jadwal_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="dokter_id" class="form-label"><strong>Dokter</strong></label>
                    <select name="dokter_id" id="dokter_id" class="form-control" required>
                        <option value="">Pilih Dokter</option>
                        @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->dokter_id }}" {{ old('dokter_id', $jadwalPraktek->dokter_id) == $dokter->dokter_id ? 'selected' : '' }}>
                                {{ $dokter->nama_dokter }} ({{ $dokter->spesialisasi }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="hari" class="form-label"><strong>Hari</strong></label>
                    <input type="text" name="hari" id="hari" class="form-control" value="{{ old('hari', $jadwalPraktek->hari) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="jam_mulai" class="form-label"><strong>Jam Mulai</strong></label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ old('jam_mulai', $jadwalPraktek->jam_mulai) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="jam_selesai" class="form-label"><strong>Jam Selesai</strong></label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ old('jam_selesai', $jadwalPraktek->jam_selesai) }}" required>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('jadwal-praktek.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection