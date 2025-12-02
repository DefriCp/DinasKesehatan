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
        Schema::create('tenaga_kesmas_kesling_dan_gizi', function (Blueprint $table) {
            $table->id();

            $table->string('unit_kerja');

            // Tenaga Kesehatan Masyarakat
            $table->integer('kesmas_l')->default(0);
            $table->integer('kesmas_p')->default(0);
            $table->integer('kesmas_total')->default(0);

            // Tenaga Kesling
            $table->integer('kesling_l')->default(0);
            $table->integer('kesling_p')->default(0);
            $table->integer('kesling_total')->default(0);

            // Tenaga Gizi
            $table->integer('gizi_l')->default(0);
            $table->integer('gizi_p')->default(0);
            $table->integer('gizi_total')->default(0);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_kesmas_kesling_dan_gizi');
    }
};
