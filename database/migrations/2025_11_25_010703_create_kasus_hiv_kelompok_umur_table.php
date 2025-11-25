<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_hiv_kelompok_umur', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger('tahun')->nullable();

            // Contoh: "≤ 4 TAHUN", "5 - 14 TAHUN", "25 - 49 TAHUN", "≥ 50 TAHUN"
            $table->string('kelompok_umur');

            // Kasus HIV
            $table->unsignedInteger('kasus_l')->default(0);
            $table->unsignedInteger('kasus_p')->default(0);
            $table->unsignedInteger('kasus_total')->default(0);

            // Proporsi kelompok umur (% dari total kasus HIV)
            $table->decimal('proporsi_kelompok_umur_persen', 5, 1)->nullable();

            // Indikator kabupaten (boleh diisi di satu baris TOTAL atau salah satu baris saja)
            $table->unsignedInteger('estimasi_orang_berisiko')->nullable();           // 43.792
            $table->unsignedInteger('berisiko_dapat_pelayanan')->nullable();         // 31.259
            $table->decimal('persen_berisiko_dapat_pelayanan', 5, 1)->nullable();    // 71,4

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_hiv_kelompok_umur');
    }
};
