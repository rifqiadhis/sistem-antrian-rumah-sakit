<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'nama',
        'alamat',
        'nomor_telepon',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'foto_profil'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function antrians()
    {
        return $this->hasMany(Antrian::class, 'pasien_id', 'id');
    }
}
