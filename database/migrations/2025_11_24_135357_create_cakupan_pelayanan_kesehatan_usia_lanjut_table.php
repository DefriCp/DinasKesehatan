<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cakupan_pelayanan_kesehatan_usia_lanjut', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable(); // kalau mau simpan per tahun

            // Usia lanjut 60+ (penduduk)
            $table->unsignedInteger('lansia_laki_laki')->default(0);
            $table->unsignedInteger('lansia_perempuan')->default(0);
            $table->unsignedInteger('lansia_total')->default(0);

            // Mendapat skrining kesehatan sesuai standar
            $table->unsignedInteger('skrining_laki_laki_jumlah')->default(0);
            $table->decimal('skrining_laki_laki_persen', 6, 1)->nullable();

            $table->unsignedInteger('skrining_perempuan_jumlah')->default(0);
            $table->decimal('skrining_perempuan_persen', 6, 1)->nullable();

            $table->unsignedInteger('skrining_total_jumlah')->default(0);
            $table->decimal('skrining_total_persen', 6, 1)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cakupan_pelayanan_kesehatan_usia_lanjut');
    }
};
