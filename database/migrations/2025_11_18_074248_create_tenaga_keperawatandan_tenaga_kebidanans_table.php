<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenaga_keperawatandan_tenaga_kebidanan', function (Blueprint $table) {
            $table->id();

            $table->string('unit_kerja');

            // Tenaga Keperawatan
            $table->integer('perawat_l')->default(0);
            $table->integer('perawat_p')->default(0);
            $table->integer('perawat_total')->default(0);

            // Tenaga Kebidanan (total saja)
            $table->integer('bidan_total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenaga_keperawatandan_tenaga_kebidanan');
    }
};

