<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_baru_kusta', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // PB (Pausi Basiler / Kusta kering)
            $table->unsignedInteger('pb_l')->default(0);
            $table->unsignedInteger('pb_p')->default(0);
            $table->unsignedInteger('pb_total')->default(0);

            // MB (Multi Basiler / Kusta basah)
            $table->unsignedInteger('mb_l')->default(0);
            $table->unsignedInteger('mb_p')->default(0);
            $table->unsignedInteger('mb_total')->default(0);

            // Total PB + MB
            $table->unsignedInteger('total_l')->default(0);
            $table->unsignedInteger('total_p')->default(0);
            $table->unsignedInteger('total_kasus')->default(0);

            // Opsional: NCDR per 100.000 penduduk (bisa diisi di 1 baris saja untuk kab/kota)
            $table->decimal('ncdr_l_per100k', 6, 2)->nullable();
            $table->decimal('ncdr_p_per100k', 6, 2)->nullable();
            $table->decimal('ncdr_total_per100k', 6, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_baru_kusta');
    }
};
