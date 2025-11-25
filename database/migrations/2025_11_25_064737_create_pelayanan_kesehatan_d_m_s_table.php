<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan_kesehatan_dm', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Jumlah penderita DM (semua umur / sesuai definisi tabel)
            $table->unsignedInteger('jumlah_penderita_dm')->default(0);

            // Penderita DM yang mendapatkan pelayanan sesuai standar
            $table->unsignedInteger('pelayanan_jumlah')->default(0);
            $table->decimal('pelayanan_persen', 6, 2)->nullable(); // contoh: 110,7

            // Catatan opsional
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan_kesehatan_dm');
    }
};
