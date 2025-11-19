<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ttd_ibu_hamils', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');

            $table->integer('jumlah_ibu_hamil')->default(0);

            $table->integer('dapat_ttd')->default(0);
            $table->decimal('dapat_ttd_persen', 5, 1)->default(0);

            $table->integer('konsumsi_ttd')->default(0);
            $table->decimal('konsumsi_ttd_persen', 5, 1)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ttd_ibu_hamils');
    }
};
