<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan_kesehatan_odgj_berat', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Sasaran ODGJ berat (total semua umur / sesuai kolom SASARAN ODGJ BERAT)
            $table->unsignedInteger('sasaran_odgj_berat')->default(0);

            // SKIZOFRENIA per kelompok umur
            $table->unsignedInteger('skizo_0_14')->default(0);
            $table->unsignedInteger('skizo_15_59')->default(0);
            $table->unsignedInteger('skizo_60_plus')->default(0);

            // PSIKOTIK AKUT per kelompok umur
            $table->unsignedInteger('psikotik_0_14')->default(0);
            $table->unsignedInteger('psikotik_15_59')->default(0);
            $table->unsignedInteger('psikotik_60_plus')->default(0);

            // TOTAL ODGJ BERAT yang mendapatkan pelayanan, per umur
            $table->unsignedInteger('total_0_14')->default(0);
            $table->unsignedInteger('total_15_59')->default(0);
            $table->unsignedInteger('total_60_plus')->default(0);

            // JUMLAH & %
            $table->unsignedInteger('pelayanan_jumlah')->default(0); // kolom JUMLAH
            $table->decimal('pelayanan_persen', 5, 2)->nullable();   // kolom %, contoh 96,9

            // Catatan opsional
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan_kesehatan_odgj_berat');
    }
};
