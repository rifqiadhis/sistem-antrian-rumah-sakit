<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\WhapiService;
use Illuminate\Http\Request;
use App\Models\Pasien;

class LoginController extends Controller
{
    protected $whapiService;

    public function __construct(WhapiService $whapiService)
    {
        $this->whapiService = $whapiService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function requestOtp(Request $request)
    {
        $request->validate(['phone_number' => 'required|numeric']);
        $phoneNumber = $request->phone_number;
        $userType = null;

        if ($phoneNumber == config('services.whapi.manager_number')) {
            $userType = 'admin';
        } else {
            $pasien = Pasien::where('nomor_telepon', $phoneNumber)->first();
            if ($pasien) {
                $userType = 'pasien';
            }
        }

        if (!$userType) {
            return back()->with('error', 'Nomor WhatsApp Anda tidak terdaftar.');
        }

        $otp = rand(100000, 999999);
        $message = "Kode OTP Sistem Antrian RS: *$otp*. Jangan berikan kode ini kepada siapapun.";
        
        $isSent = $this->whapiService->sendMessage($phoneNumber, $message);

        if (!$isSent) {
            return back()->with('error', 'Gagal mengirim OTP. Silakan coba lagi nanti.');
        }

        $request->session()->put([
            'otp_code' => $otp,
            'otp_phone_number' => $phoneNumber,
            'otp_user_type' => $userType,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        return redirect()->route('login.otp')->with('success', 'Kode OTP telah dikirim ke WhatsApp Anda.');
    }

    public function showOtpForm()
    {
        if (!session('otp_phone_number')) {
            return redirect()->route('login');
        }
        return view('auth.otp');
    }

    public function verifyAndLogin(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);
        $sessionOtp = $request->session()->get('otp_code');
        $phoneNumber = $request->session()->get('otp_phone_number');
        $userType = $request->session()->get('otp_user_type');
        if (!$sessionOtp || $request->otp != $sessionOtp || now()->isAfter(session('otp_expires_at'))) {
            return back()->with('error', 'Kode OTP salah atau sudah kedaluwarsa.');
        }
        $request->session()->forget(['otp_code', 'otp_phone_number', 'otp_user_type', 'otp_expires_at']);
        $request->session()->regenerate();
        if ($userType === 'admin') {
            $request->session()->put('auth_user_role', 'admin');
            return redirect()->intended(route('admin.dashboard'));
        }
        if ($userType === 'pasien') {
            $pasien = Pasien::where('nomor_telepon', $phoneNumber)->first();
            $request->session()->put('auth_user_role', 'pasien');
            $request->session()->put('auth_pasien_id', $pasien->id);
            return redirect()->intended(route('pasien.dashboard'));
        }
        return redirect()->route('login')->with('error', 'Gagal melakukan otentikasi.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}