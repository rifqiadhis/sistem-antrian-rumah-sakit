<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Dokter;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pasienId = session('auth_pasien_id');
        $pasien = Pasien::findOrFail($pasienId);

        $antrianHariIni = Antrian::where('pasien_id', $pasienId)
                                 ->whereDate('created_at', Carbon::today())
                                 ->whereIn('status', ['Menunggu', 'Diproses'])
                                 ->first();

        $sisaAntrian = 0;
        if ($antrianHariIni) {
            $sisaAntrian = Antrian::where('dokter_id', $antrianHariIni->dokter_id)
                                  ->whereDate('created_at', Carbon::today())
                                  ->where('status', 'Menunggu')
                                  ->where('nomor_antrian', '<', $antrianHariIni->nomor_antrian)
                                  ->count();
        }

        $riwayatAntrian = Antrian::where('pasien_id', $pasienId)
                                 ->with('dokter')
                                 ->latest()
                                 ->paginate(5);

        return view('pasienmenu.dashboard', [
            'pasien' => $pasien,
            'antrianHariIni' => $antrianHariIni,
            'sisaAntrian' => $sisaAntrian,
            'riwayatAntrian' => $riwayatAntrian,
        ]);
    }
}