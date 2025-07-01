<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::latest('dokter_id')->paginate(5);
        return view('dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter'   => 'required|string|min:3|max:100',
            'spesialisasi'  => 'required|string|max:100',
            'kontak'        => 'required|string|numeric'
        ]);

        Dokter::create($request->all());

        return redirect()->route('dokter.index')->with('success', 'Data Dokter Berhasil Disimpan!');
    }

    public function show(Dokter $dokter)
    {
        return view('dokter.show', compact('dokter'));
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama_dokter'   => 'required|string|min:3|max:100',
            'spesialisasi'  => 'required|string|max:100',
            'kontak'        => 'required|string|numeric'
        ]);

        $dokter->update($request->all());

        return redirect()->route('dokter.index')->with('success', 'Data Dokter Berhasil Diubah!');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data Dokter Berhasil Dihapus!');
    }
}