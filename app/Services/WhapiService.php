<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhapiService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.whapi.url');
        $this->apiKey = config('services.whapi.key');
    }

    public function sendMessage(string $phoneNumber, string $message): bool
    {
        if (!$this->apiUrl || !$this->apiKey) {
            Log::error('Whapi Service: URL atau API Key belum di-setting.');
            return false;
        }

        $endpoint = '/api/sendMessage'; 

        try {
            $response = Http::withoutVerifying()->withHeaders([
                'Content-Type' => 'application/json; charset=utf-8',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post($this->apiUrl . $endpoint, [
                'apiKey' => $this->apiKey,
                'phone' => $phoneNumber,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info('Pesan Whapi berhasil dikirim ke ' . $phoneNumber);
                return true;
            } else {
                Log::error('Gagal mengirim pesan Whapi: ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Exception saat mengirim pesan Whapi: ' . $e->getMessage());
            return false;
        }
    }
}