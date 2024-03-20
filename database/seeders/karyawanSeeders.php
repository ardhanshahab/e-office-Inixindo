<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class karyawanSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawans')->insert([
            'foto' => null,
            'nip' => '01000000',
            'nama_lengkap' => 'Ifik Arifin',
            'divisi' => 'Direksi',
            'jabatan' => 'Komisaris',

            'status_aktif' => '1',

            'keterangan' => 'Komisaris',
            ]);
    }
}
