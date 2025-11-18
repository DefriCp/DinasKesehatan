<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jam_kes_penduduks', function (Blueprint $table) {
            $table->id();

            $table->string('jenis_kepesertaan'); // PBI APBN, PBI APBD, dll
            $table->bigInteger('jumlah')->default(0);
            $table->decimal('persentase', 5, 2)->default(0); // simpan 51.30, 14.10, dst.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jam_kes_penduduks');
    }
};
