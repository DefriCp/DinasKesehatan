<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penderita_kronis_filariasis', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Kasus kronis tahun sebelumnya
            $table->unsignedInteger('sebelumnya_l')->default(0);
            $table->unsignedInteger('sebelumnya_p')->default(0);
            $table->unsignedInteger('sebelumnya_total')->default(0);

            // Kasus kronis baru ditemukan
            $table->unsignedInteger('baru_l')->default(0);
            $table->unsignedInteger('baru_p')->default(0);
            $table->unsignedInteger('baru_total')->default(0);

            // Kasus kronis pindah
            $table->unsignedInteger('pindah_l')->default(0);
            $table->unsignedInteger('pindah_p')->default(0);
            $table->unsignedInteger('pindah_total')->default(0);

            // Kasus kronis meninggal
            $table->unsignedInteger('meninggal_l')->default(0);
            $table->unsignedInteger('meninggal_p')->default(0);
            $table->unsignedInteger('meninggal_total')->default(0);

            // Jumlah seluruh kasus kronis
            $table->unsignedInteger('jumlah_l')->default(0);
            $table->unsignedInteger('jumlah_p')->default(0);
            $table->unsignedInteger('jumlah_total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penderita_kronis_filariasis');
    }
};
