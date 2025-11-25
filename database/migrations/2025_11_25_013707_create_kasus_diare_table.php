<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_diare', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // JUMLAH PENDUDUK
            $table->unsignedInteger('jumlah_penduduk')->default(0);

            // JUMLAH TARGET PENEMUAN DIARE
            $table->unsignedInteger('target_penemuan_semua_umur')->default(0);
            $table->unsignedInteger('target_penemuan_balita')->default(0);

            // DIARE DILAYANI - SEMUA UMUR & BALITA
            $table->unsignedInteger('diare_dilayani_semua_jumlah')->default(0);
            $table->decimal('diare_dilayani_semua_persen', 6, 1)->nullable();

            $table->unsignedInteger('diare_dilayani_balita_jumlah')->default(0);
            $table->decimal('diare_dilayani_balita_persen', 6, 1)->nullable();

            // MENDAPAT ORALIT - SEMUA UMUR & BALITA
            $table->unsignedInteger('oralit_semua_jumlah')->default(0);
            $table->decimal('oralit_semua_persen', 6, 1)->nullable();

            $table->unsignedInteger('oralit_balita_jumlah')->default(0);
            $table->decimal('oralit_balita_persen', 6, 1)->nullable();

            // MENDAPAT ZINC - BALITA
            $table->unsignedInteger('zinc_balita_jumlah')->default(0);
            $table->decimal('zinc_balita_persen', 6, 1)->nullable();

            // MENDAPAT ORALIT + ZINC - BALITA
            $table->unsignedInteger('oralit_zinc_balita_jumlah')->default(0);
            $table->decimal('oralit_zinc_balita_persen', 6, 1)->nullable();

            // OPSIONAL: Angka kesakitan diare per 1.000 penduduk (kab/kota)
            // Hanya diisi di 1 baris khusus bila mau
            $table->decimal('angka_kesakitan_semua_per1000', 8, 2)->nullable();
            $table->decimal('angka_kesakitan_balita_per1000', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_diare');
    }
};
