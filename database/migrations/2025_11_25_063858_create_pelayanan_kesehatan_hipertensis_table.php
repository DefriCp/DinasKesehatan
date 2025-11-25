<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan_kesehatan_hipertensi', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Estimasi penderita hipertensi ≥ 15 tahun
            $table->unsignedInteger('estimasi_l')->default(0);
            $table->unsignedInteger('estimasi_p')->default(0);
            $table->unsignedInteger('estimasi_total')->default(0);

            // Mendapat pelayanan kesehatan - Laki-laki
            $table->unsignedInteger('pelayanan_l_jumlah')->default(0);
            $table->decimal('pelayanan_l_persen', 6, 2)->nullable();

            // Mendapat pelayanan kesehatan - Perempuan
            $table->unsignedInteger('pelayanan_p_jumlah')->default(0);
            $table->decimal('pelayanan_p_persen', 6, 2)->nullable();

            // Mendapat pelayanan kesehatan - Total
            $table->unsignedInteger('pelayanan_total_jumlah')->default(0);
            $table->decimal('pelayanan_total_persen', 6, 2)->nullable();

            // (Opsional) Catatan tambahan kalau mau dipakai
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan_kesehatan_hipertensi');
    }
};
