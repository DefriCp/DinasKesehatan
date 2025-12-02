<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenaga_teknik_biomedika_keterapian_keteknisian', function (Blueprint $table) {
            $table->id();

            $table->string('unit_kerja');

            // Ahli Teknologi Laboratorium Medik
            $table->integer('atl_l')->default(0);
            $table->integer('atl_p')->default(0);
            $table->integer('atl_total')->default(0);

            // Tenaga Teknik Biomedika Lainnya
            $table->integer('biomedika_l')->default(0);
            $table->integer('biomedika_p')->default(0);
            $table->integer('biomedika_total')->default(0);

            // Keterapian Fisik
            $table->integer('keterapian_l')->default(0);
            $table->integer('keterapian_p')->default(0);
            $table->integer('keterapian_total')->default(0);

            // Keteknisian Medis
            $table->integer('keteknisian_l')->default(0);
            $table->integer('keteknisian_p')->default(0);
            $table->integer('keteknisian_total')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_teknik_biomedika_keterapian_keteknisian');
    }
};
