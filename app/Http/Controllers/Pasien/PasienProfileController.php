<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PasienProfileController extends Controller
{
    public function edit()
    {
        $pasienId = session('auth_pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        return view('pasienmenu.profile.edit', compact('pasien'));
    }


    public function update(Request $request)
    {
        $pasienId = session('auth_pasien_id');
        $pasien = Pasien::findOrFail($pasienId);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('pasiens')->ignore($pasienId, 'id')],
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $updateData = $request->except('foto_profil');

        if ($request->hasFile('foto_profil')) {
            if ($pasien->foto_profil) {
                Storage::disk('public')->delete($pasien->foto_profil);
            }

            $path = $request->file('foto_profil')->store('profil-pasiens', 'public');
            $updateData['foto_profil'] = $path;
        }
        
        $pasien->update($updateData);

        return redirect()->route('pasien.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}