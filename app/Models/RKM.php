<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RKM extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_key',
        'materi_key',
        'perusahaan_key',
        'pax',
        'tanggal_awal',
        'tanggal_akhir',
        'metode_kelas',
        'event',
        'ruang',
        'instruktur_key',
        'status',
    ];

    public function sales()
    {
        return $this->belongsTo(Karyawan::class, 'sales_key', 'kode_karyawan');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_key', 'id');
    }

    public function instruktur()
    {
        return $this->belongsTo(Karyawan::class, 'instruktur_key', 'kode_karyawan');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_key', 'id');
    }
}
