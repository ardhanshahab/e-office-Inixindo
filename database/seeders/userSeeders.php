<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class userSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $faker = Faker::create('id_ID');

    for($i = 1; $i <= 50; $i++){

    DB::table('users')->insert([
            'name' => $faker->name,
            'role' => 'pegawai',
            'nip' => $faker->randomNumber,
            'alamat' => $faker->address,
            'jabatan' => $faker->jobTitle,
            'divisi' => 'education',
            'tempat_lahir' => $faker->city,
            'tanggal_lahir' => $faker->date,
            'email' => $faker->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            ]);
        }
    }
}
