<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_malaria', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Suspek malaria
            $table->unsignedInteger('suspek')->default(0);

            // Konfirmasi laboratorium
            $table->unsignedInteger('konfirmasi_mikroskopis')->default(0);
            $table->unsignedInteger('konfirmasi_rdt')->default(0);
            $table->unsignedInteger('konfirmasi_total')->default(0);
            $table->decimal('konfirmasi_persen', 6, 2)->nullable(); // % konfirmasi

            // Positif
            $table->unsignedInteger('positif_l')->default(0);
            $table->unsignedInteger('positif_p')->default(0);
            $table->unsignedInteger('positif_total')->default(0);

            // Pengobatan standar
            $table->unsignedInteger('pengobatan_l')->default(0);
            $table->unsignedInteger('pengobatan_p')->default(0);
            $table->unsignedInteger('pengobatan_total')->default(0);
            $table->decimal('pengobatan_persen', 6, 2)->nullable(); // % pengobatan standar

            // Meninggal
            $table->unsignedInteger('meninggal_l')->default(0);
            $table->unsignedInteger('meninggal_p')->default(0);
            $table->unsignedInteger('meninggal_total')->default(0);

            // CFR (%)
            $table->decimal('cfr_l_persen', 6, 2)->nullable();
            $table->decimal('cfr_p_persen', 6, 2)->nullable();
            $table->decimal('cfr_total_persen', 6, 2)->nullable();

            // Annual Parasite Incidence (API) per 1.000 penduduk (kab/kota)
            $table->decimal('api_per1000', 6, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_malaria');
    }
};
