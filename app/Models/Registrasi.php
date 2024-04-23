<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_rkm',
        'id_peserta',
        'id_materi',
    ];
    public function rkm()
    {
        return $this->belongsTo(RKM::class, 'id_rkm', 'id');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi', 'id');
    }
}
