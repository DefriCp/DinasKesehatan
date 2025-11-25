<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kasus_flu_burung', function (Blueprint $table) {
            $table->id();

            // Identitas wilayah
            $table->string('kecamatan');
            $table->string('puskesmas');
            $table->unsignedSmallInteger('tahun')->nullable();

            // Jumlah kasus flu burung
            $table->unsignedInteger('kasus_l')->default(0);
            $table->unsignedInteger('kasus_p')->default(0);
            $table->unsignedInteger('kasus_total')->default(0);

            // Jumlah kematian
            $table->unsignedInteger('kematian_l')->default(0);
            $table->unsignedInteger('kematian_p')->default(0);
            $table->unsignedInteger('kematian_total')->default(0);

            // Catatan opsional
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kasus_flu_burung');
    }
};
