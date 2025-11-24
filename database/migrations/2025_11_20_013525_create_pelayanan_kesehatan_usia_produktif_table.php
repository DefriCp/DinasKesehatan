<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan_kesehatan_usia_produktifs', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');

            // Penduduk usia 15-59 tahun
            $table->unsignedInteger('penduduk_l')->nullable();
            $table->unsignedInteger('penduduk_p')->nullable();
            $table->unsignedInteger('penduduk_total')->nullable();

            // Mendapat pelayanan skrining kesehatan sesuai standar
            $table->unsignedInteger('skrining_l')->nullable();
            $table->decimal('skrining_l_persen', 6, 1)->nullable();

            $table->unsignedInteger('skrining_p')->nullable();
            $table->decimal('skrining_p_persen', 6, 1)->nullable();

            $table->unsignedInteger('skrining_total')->nullable();
            $table->decimal('skrining_total_persen', 6, 1)->nullable();

            // Berisiko
            $table->unsignedInteger('berisiko_l')->nullable();
            $table->decimal('berisiko_l_persen', 6, 1)->nullable();

            $table->unsignedInteger('berisiko_p')->nullable();
            $table->decimal('berisiko_p_persen', 6, 1)->nullable();

            $table->unsignedInteger('berisiko_total')->nullable();
            $table->decimal('berisiko_total_persen', 6, 1)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan_kesehatan_usia_produktifs');
    }
};
