<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $primaryKey = 'dokter_id';

    protected $fillable = [
        'nama_dokter',
        'spesialisasi',
        'kontak',
    ];

    public function jadwalPrakteks()
    {
        return $this->hasMany(JadwalPraktek::class, 'dokter_id', 'dokter_id');
    }

    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'dokter_id', 'dokter_id');
    }
}
