<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan_kesehatan_ibu', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');

            // IBU HAMIL
            $table->integer('ibu_hamil_jumlah')->default(0);

            $table->integer('k1_jumlah')->default(0);
            $table->decimal('k1_persen', 5, 1)->default(0);

            $table->integer('k4_jumlah')->default(0);
            $table->decimal('k4_persen', 5, 1)->default(0);

            $table->integer('k6_jumlah')->default(0);
            $table->decimal('k6_persen', 5, 1)->default(0);

            // IBU BERSALIN / NIFAS
            $table->integer('ibu_bersalin_jumlah')->default(0);

            $table->integer('persalinan_fasyankes_jumlah')->default(0);
            $table->decimal('persalinan_fasyankes_persen', 5, 1)->default(0);

            $table->integer('kf1_jumlah')->default(0);
            $table->decimal('kf1_persen', 5, 1)->default(0);

            $table->integer('kf_lengkap_jumlah')->default(0);
            $table->decimal('kf_lengkap_persen', 5, 1)->default(0);

            $table->integer('nifas_vita_jumlah')->default(0);
            $table->decimal('nifas_vita_persen', 5, 1)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan_kesehatan_ibu');
    }
};
