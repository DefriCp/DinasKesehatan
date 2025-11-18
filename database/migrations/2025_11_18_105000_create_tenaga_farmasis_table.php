<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenaga_farmasi', function (Blueprint $table) {
            $table->id();

            $table->string('unit_kerja');

            // Tenaga Teknis Kefarmasian (TTK)
            $table->integer('ttk_l')->default(0);
            $table->integer('ttk_p')->default(0);
            $table->integer('ttk_total')->default(0);

            // Apoteker
            $table->integer('apoteker_l')->default(0);
            $table->integer('apoteker_p')->default(0);
            $table->integer('apoteker_total')->default(0);

            // Total Tenaga Farmasi
            $table->integer('total_l')->default(0);
            $table->integer('total_p')->default(0);
            $table->integer('total_total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenaga_farmasi');
    }
};
