<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kejadian_luar_biasa', function (Blueprint $table) {
            $table->id();

            // Identitas KLB
            $table->string('jenis_klb');             // Keracunan makanan, Pertusis, dsb
            $table->unsignedSmallInteger('jumlah_kec')->default(0);
            $table->unsignedSmallInteger('jumlah_desa_kel')->default(0);

            // Waktu kejadian
            $table->date('tanggal_diketahui')->nullable();
            $table->date('tanggal_ditanggulangi')->nullable();
            $table->date('tanggal_akhir')->nullable();

            // Jumlah penderita (L / P / L+P)
            $table->unsignedInteger('penderita_l')->default(0);
            $table->unsignedInteger('penderita_p')->default(0);
            $table->unsignedInteger('penderita_total')->default(0);

            // Kelompok umur penderita (jumlah total, tidak pecah L/P)
            $table->unsignedInteger('umur_0_7_hari')->default(0);
            $table->unsignedInteger('umur_8_28_hari')->default(0);
            $table->unsignedInteger('umur_1_11_bln')->default(0);
            $table->unsignedInteger('umur_1_4_thn')->default(0);
            $table->unsignedInteger('umur_5_9_thn')->default(0);
            $table->unsignedInteger('umur_10_14_thn')->default(0);
            $table->unsignedInteger('umur_15_19_thn')->default(0);
            $table->unsignedInteger('umur_20_44_thn')->default(0);
            $table->unsignedInteger('umur_45_54_thn')->default(0);
            $table->unsignedInteger('umur_55_59_thn')->default(0);
            $table->unsignedInteger('umur_60_69_thn')->default(0);
            $table->unsignedInteger('umur_70_plus_thn')->default(0);

            // Jumlah kematian
            $table->unsignedInteger('kematian_l')->default(0);
            $table->unsignedInteger('kematian_p')->default(0);
            $table->unsignedInteger('kematian_total')->default(0);

            // Jumlah penduduk terancam
            $table->unsignedInteger('penduduk_terancam_l')->default(0);
            $table->unsignedInteger('penduduk_terancam_p')->default(0);
            $table->unsignedInteger('penduduk_terancam_total')->default(0);

            // Attack Rate (%)
            $table->decimal('attack_rate_l_persen', 6, 2)->nullable();
            $table->decimal('attack_rate_p_persen', 6, 2)->nullable();
            $table->decimal('attack_rate_total_persen', 6, 2)->nullable();

            // Case Fatality Rate (%)
            $table->decimal('cfr_l_persen', 6, 2)->nullable();
            $table->decimal('cfr_p_persen', 6, 2)->nullable();
            $table->decimal('cfr_total_persen', 6, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kejadian_luar_biasa');
    }
};
