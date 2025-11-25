<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deteksi_hepatitis_bumil', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Jumlah ibu hamil (sasaran)
            $table->unsignedInteger('jumlah_ibu_hamil')->default(0);

            // Ibu hamil diperiksa hepatitis B
            $table->unsignedInteger('ibu_hamil_diperiksa_reaktif')->default(0);
            $table->unsignedInteger('ibu_hamil_diperiksa_nonreaktif')->default(0);
            $table->unsignedInteger('ibu_hamil_diperiksa_total')->default(0);

            // % ibu hamil diperiksa dari seluruh bumil
            $table->decimal('persen_bumil_diperiksa', 5, 1)->nullable();

            // % bumil reaktif dari yang diperiksa
            $table->decimal('persen_bumil_reaktif', 5, 1)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deteksi_hepatitis_bumil');
    }
};
