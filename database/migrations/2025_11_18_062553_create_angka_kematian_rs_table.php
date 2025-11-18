<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('angka_kematian_rs', function (Blueprint $table) {
        $table->id();

        $table->string('nama_rs');
        $table->integer('tempat_tidur')->nullable();

        // Pasien Keluar Hidup + Mati
        $table->integer('pk_l')->nullable();
        $table->integer('pk_p')->nullable();
        $table->integer('pk_total')->nullable();

        // Pasien Keluar Mati
        $table->integer('m_l')->nullable();
        $table->integer('m_p')->nullable();
        $table->integer('m_total')->nullable();

        // Mati ≥ 48 Jam Dirawat
        $table->integer('m48_l')->nullable();
        $table->integer('m48_p')->nullable();
        $table->integer('m48_total')->nullable();

        // Gross Death Rate (GDR)
        $table->decimal('gdr_l', 8,2)->nullable();
        $table->decimal('gdr_p', 8,2)->nullable();
        $table->decimal('gdr_total', 8,2)->nullable();

        // Net Death Rate (NDR)
        $table->decimal('ndr_l', 8,2)->nullable();
        $table->decimal('ndr_p', 8,2)->nullable();
        $table->decimal('ndr_total', 8,2)->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_mortality_stats');
    }
};
