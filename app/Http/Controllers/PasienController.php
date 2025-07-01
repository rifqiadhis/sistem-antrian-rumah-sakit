<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::latest()->paginate(10); 
        return view('pasien.index', compact('pasien'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|string|email|unique:pasien',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function show($id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')->with('error', 'Pasien tidak ditemukan.');
        }

        return view('pasien.show', compact('pasien'));
    }

    public function edit($id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')->with('error', 'Pasien tidak ditemukan.');
        }

        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|string|email|unique:pasien,email,' . $pasien->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
