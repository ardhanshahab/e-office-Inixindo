<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'foto',
        'nip',
        'nama_lengkap',
        'divisi',
        'jabatan',
        'rekening_maybank',
        'rekening_bca',
        'status_aktif',
        'awal_probation',
        'akhir_probation',
        'awal_kontrak',
        'akhir_kontrak',
        'awal_tetap',
        'akhir_tetap',
        'keterangan',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'karyawan_id');
    }

}
