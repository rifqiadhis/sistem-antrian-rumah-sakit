<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktek;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalPraktekController extends Controller
{
    public function index()
    {
        $jadwalPrakteks = JadwalPraktek::with('dokter')->latest()->paginate(10);
        return view('jadwal_praktek.index', compact('jadwalPrakteks'));
    }

    public function create()
    {
        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('jadwal_praktek.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,dokter_id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i', // Validasi format jam
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPraktek::create($request->all());
        return redirect()->route('jadwal-praktek.index')->with('success', 'Jadwal Praktek berhasil ditambahkan.');
    }

    public function show(JadwalPraktek $jadwalPraktek)
    {
        $jadwalPraktek->load('dokter');
        return view('jadwal_praktek.show', compact('jadwalPraktek'));
    }

    public function edit(JadwalPraktek $jadwalPraktek)
    {
        $dokters = Dokter::orderBy('nama_dokter')->get();
        return view('jadwal_praktek.edit', compact('jadwalPraktek', 'dokters'));
    }

    public function update(Request $request, JadwalPraktek $jadwalPraktek)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,dokter_id',
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwalPraktek->update($request->all());
        return redirect()->route('jadwal-praktek.index')->with('success', 'Jadwal Praktek berhasil diperbarui.');
    }

    public function destroy(JadwalPraktek $jadwalPraktek)
    {
        $jadwalPraktek->delete();
        return redirect()->route('jadwal-praktek.index')->with('success', 'Jadwal Praktek berhasil dihapus.');
    }
}