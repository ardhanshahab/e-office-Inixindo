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
        'harga_jual',
        'pax',
        'tanggal_awal',
        'tanggal_akhir',
        'metode_kelas',
        'event',
        'ruang',
        'instruktur_key',
        'instruktur_key2',
        'asisten_key',
        'status',
        'isi_pax'
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

    public function instruktur2()
    {
        return $this->belongsTo(Karyawan::class, 'instruktur_key2', 'kode_karyawan');
    }

    public function asisten()
    {
        return $this->belongsTo(Karyawan::class, 'asisten_key', 'kode_karyawan');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_key', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'rkm_key', 'id');
    }

}
