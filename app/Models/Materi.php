<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_materi',
        'kode_materi',
        'kategori_materi',
        'vendor',
        'silabus'
    ];

    public function rkms()
    {
        return $this->hasMany(Rkm::class, 'materi_key', 'id');
    }
}
