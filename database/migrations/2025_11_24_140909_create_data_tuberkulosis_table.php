<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_tuberkulosis', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan')->nullable(); // RSUD & RSIA ga punya kecamatan di tabel
            $table->string('puskesmas');             // termasuk RSUD/RSIA
            $table->unsignedSmallInteger('tahun')->nullable();

            // JUMLAH TERDUGA TUBERKULOSIS YANG MENDAPAT PELAYANAN SESUAI STANDAR
            $table->unsignedInteger('jumlah_terduga_tb_pelayanan')->default(0);

            // JUMLAH SEMUA KASUS TUBERKULOSIS
            $table->unsignedInteger('kasus_tb_laki_laki_jumlah')->default(0);
            $table->decimal('kasus_tb_laki_laki_persen', 6, 1)->nullable();

            $table->unsignedInteger('kasus_tb_perempuan_jumlah')->default(0);
            $table->decimal('kasus_tb_perempuan_persen', 6, 1)->nullable();

            $table->unsignedInteger('kasus_tb_total_jumlah')->default(0);

            // KASUS TUBERKULOSIS ANAK 0-14 TAHUN
            $table->unsignedInteger('kasus_tb_anak_0_14_jumlah')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_tuberkulosis');
    }
};
