<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien; // Import model Pasien
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|numeric|unique:pasiens,nomor_telepon',
            'email' => 'required|string|email|max:255|unique:pasiens,email',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan nomor WhatsApp Anda.');
    }
}