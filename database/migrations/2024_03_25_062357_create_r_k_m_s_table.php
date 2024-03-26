<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('r_k_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('sales_key');
            $table->string('materi_key');
            $table->string('perusahaan_key');
            $table->string('pax');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->string('metode_kelas');
            $table->string('event');
            $table->string('ruang');
            $table->string('instruktur_key');
            $table->enum('status', ['0', '1', '2']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_k_m_s');
    }
};
