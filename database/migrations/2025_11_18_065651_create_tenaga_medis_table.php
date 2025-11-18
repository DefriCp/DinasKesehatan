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
    Schema::create('tenaga_medis', function (Blueprint $table) {
        $table->id();
        $table->string('unit_kerja');

        // Dokter Spesialis
        $table->integer('sp_l')->default(0);
        $table->integer('sp_p')->default(0);
        $table->integer('sp_total')->default(0);

        // Dokter Umum
        $table->integer('dr_l')->default(0);
        $table->integer('dr_p')->default(0);
        $table->integer('dr_total')->default(0);

        // Total Dokter
        $table->integer('dokter_l')->default(0);
        $table->integer('dokter_p')->default(0);
        $table->integer('dokter_total')->default(0);

        // Dokter Gigi
        $table->integer('gigi_l')->default(0);
        $table->integer('gigi_p')->default(0);
        $table->integer('gigi_total')->default(0);

        // Dokter Gigi Spesialis
        $table->integer('gigis_l')->default(0);
        $table->integer('gigis_p')->default(0);
        $table->integer('gigis_total')->default(0);

        // Total Dokter Gigi
        $table->integer('jumlah_gigi_l')->default(0);
        $table->integer('jumlah_gigi_p')->default(0);
        $table->integer('jumlah_gigi_total')->default(0);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_medis');
    }
};
