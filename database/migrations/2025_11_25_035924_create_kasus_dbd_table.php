<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_dbd', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Jumlah kasus DBD
            $table->unsignedInteger('kasus_l')->default(0);
            $table->unsignedInteger('kasus_p')->default(0);
            $table->unsignedInteger('kasus_total')->default(0);

            // Jumlah meninggal
            $table->unsignedInteger('meninggal_l')->default(0);
            $table->unsignedInteger('meninggal_p')->default(0);
            $table->unsignedInteger('meninggal_total')->default(0);

            // CFR (%)
            $table->decimal('cfr_l_persen', 5, 1)->nullable();
            $table->decimal('cfr_p_persen', 5, 1)->nullable();
            $table->decimal('cfr_total_persen', 5, 1)->nullable();

            // Angka kesakitan DBD per 100.000 penduduk (biasanya diisi sekali di level kab/kota)
            $table->decimal('angka_kesakitan_per100k', 6, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_dbd');
    }
};
