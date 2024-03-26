<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_perusahaan',
        'kategori_perusahaan',
        'lokasi',
        'karyawan_key',
        'status',
        'npwp',
        'alamat',
        'cp',
        'no_telp',
        'foto_npwp',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_key', 'id');
    }

    public function rkms()
    {
        return $this->hasMany(Rkm::class, 'nama_perusahaan', 'perusahaan_key    ');
    }

}
