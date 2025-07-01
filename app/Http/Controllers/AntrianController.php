<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AntrianController extends Controller
{
    public function index()
    {
        $antrians = Antrian::with(['pasien', 'dokter'])
                            ->latest()
                            ->paginate(10);
        return view('antrian.index', compact('antrians'));
    }

    public function create()
    {
        $pasiens = Pasien::orderBy('nama')->get();
        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('antrian.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,dokter_id',
            'pasien_id' => [
                'required',
                'exists:pasiens,id',
                Rule::unique('antrians')->where(function ($query) {
                    return $query->whereDate('created_at', Carbon::today());
                }),
            ],
        ], [
            'pasien_id.unique' => 'Pasien ini sudah terdaftar dalam antrian hari ini.',
        ]);

        $antrian = DB::transaction(function () use ($request) {
            $antrianTerakhir = Antrian::where('dokter_id', $request->dokter_id)
                                    ->whereDate('created_at', Carbon::today())
                                    ->orderBy('nomor_antrian', 'DESC')
                                    ->lockForUpdate()
                                    ->first();

            $nomorTerakhir = $antrianTerakhir ? $antrianTerakhir->nomor_antrian : 0;
            
            $nomorAntrianBaru = $nomorTerakhir + 1;

            return Antrian::create([
                'pasien_id'     => $request->pasien_id,
                'dokter_id'     => $request->dokter_id,
                'nomor_antrian' => $nomorAntrianBaru,
                'status'        => 'Menunggu',
            ]);
        });

        return redirect()->route('antrian.index')->with('success', "Antrian #{$antrian->nomor_antrian} berhasil diambil!");
    }

    public function show(Antrian $antrian)
    {
        return view('antrian.show', compact('antrian'));
    }

    public function edit(Antrian $antrian)
    {
        return view('antrian.edit', compact('antrian'));
    }

    public function update(Request $request, Antrian $antrian)
    {
        $request->validate([
            'status' => 'required|string|in:Menunggu,Diproses,Selesai,Batal',
        ]);

        $antrian->update(['status' => $request->status]);

        return redirect()->route('antrian.index')->with('success', 'Status antrian berhasil diperbarui.');
    }

    public function destroy(Antrian $antrian)
    {
        $antrian->delete();
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dihapus.');
    }
}