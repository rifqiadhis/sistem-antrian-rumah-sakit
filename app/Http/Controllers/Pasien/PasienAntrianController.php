<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Antrian;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PasienAntrianController extends Controller
{
    public function create()
    {
        $pasien = Pasien::find(session('auth_pasien_id'));

        $antrianAktif = Antrian::where('pasien_id', $pasien->id)
                                ->whereDate('created_at', Carbon::today())
                                ->whereIn('status', ['Menunggu', 'Diproses'])
                                ->exists();
        
        if ($antrianAktif) {
            return redirect()->route('pasienmenu.dashboard')->with('error', 'Anda sudah memiliki nomor antrian aktif untuk hari ini.');
        }

        $dokters = Dokter::orderBy('nama_dokter')->get();
        
        return view('pasienmenu.antrian.create', [
            'pasien' => $pasien,
            'dokters' => $dokters
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,dokter_id',
        ]);

        $pasienId = session('auth_pasien_id');
        
        $antrianAktif = Antrian::where('pasien_id', $pasienId)
                                ->whereDate('created_at', Carbon::today())
                                ->whereIn('status', ['Menunggu', 'Diproses'])
                                ->exists();
        
        if ($antrianAktif) {
            return back()->with('error', 'Anda sudah memiliki nomor antrian aktif untuk hari ini.');
        }

        $antrian = DB::transaction(function () use ($request, $pasienId) {
            
            $antrianTerakhir = Antrian::where('dokter_id', $request->dokter_id)
                                    ->whereDate('created_at', Carbon::today())
                                    ->orderBy('nomor_antrian', 'DESC')
                                    ->lockForUpdate() // Kunci baris untuk mencegah race condition
                                    ->first();
            
            $nomorTerakhir = $antrianTerakhir ? $antrianTerakhir->nomor_antrian : 0;
            
            $nomorAntrianBaru = $nomorTerakhir + 1;

            return Antrian::create([
                'pasien_id'     => $pasienId,
                'dokter_id'     => $request->dokter_id,
                'nomor_antrian' => $nomorAntrianBaru,
                'status'        => 'Menunggu',
            ]);
        });

        return redirect()->route('pasien.dashboard')->with('success', "Antrian berhasil diambil! Nomor Anda adalah {$antrian->nomor_antrian}.");
    }
}