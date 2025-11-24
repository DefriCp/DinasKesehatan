<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pneumonia_balita', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // JUMLAH BALITA
            $table->unsignedInteger('jumlah_balita')->default(0);

            // BALITA BATUK / KESUKARAN BERNAPAS
            $table->unsignedInteger('balita_batuk_kunjungan')->default(0);
            $table->unsignedInteger('balita_batuk_tatalaksana_l')->default(0);
            $table->unsignedInteger('balita_batuk_tatalaksana_p')->default(0);
            $table->decimal('balita_batuk_tatalaksana_persen', 6, 1)->nullable();

            // PERKIRAAN PNEUMONIA BALITA
            $table->unsignedInteger('perkiraan_pneumonia_balita')->default(0);

            // REALISASI PENEMUAN PNEUMONIA PADA BALITA
            // Pneumonia tidak berat
            $table->unsignedInteger('pneumonia_l')->default(0);
            $table->unsignedInteger('pneumonia_p')->default(0);

            // Pneumonia berat
            $table->unsignedInteger('pneumonia_berat_l')->default(0);
            $table->unsignedInteger('pneumonia_berat_p')->default(0);

            // Jumlah semua pneumonia (pneumonia + pneumonia berat)
            $table->unsignedInteger('jumlah_pneumonia_l')->default(0);
            $table->unsignedInteger('jumlah_pneumonia_p')->default(0);
            $table->unsignedInteger('jumlah_pneumonia_total')->default(0);
            $table->decimal('penemuan_pneumonia_persen', 6, 1)->nullable();

            // BATUK BUKAN PNEUMONIA
            $table->unsignedInteger('batuk_non_pneumonia_l')->default(0);
            $table->unsignedInteger('batuk_non_pneumonia_p')->default(0);
            $table->unsignedInteger('batuk_non_pneumonia_total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pneumonia_balita');
    }
};
