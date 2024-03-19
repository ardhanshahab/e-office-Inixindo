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
            'nip' => '1234567890',
            'nama_lengkap' => 'Ardhan',
            'divisi' => 'Educational',
            'jabatan' => 'Programmer',
            'rekening_maybank' => '112345678',
            'rekening_bca' => '112345654',
            'status_aktif' => '1',
            'awal_probation' => null,
            'akhir_probation' => null,
            'awal_kontrak' => '2022-12-12',
            'akhir_kontrak' => '2029-12-12',
            'awal_tetap' => null,
            'akhir_tetap' => null,
            'keterangan' => Str::random(10),
            ]);
    }
}
