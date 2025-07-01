<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $primaryKey = 'antrian_id';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'nomor_antrian',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'dokter_id');
    }
}