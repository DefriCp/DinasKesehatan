<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imunisasi_td_ibu_hamils', function (Blueprint $table) {
            $table->id();

            $table->string('kecamatan');
            $table->string('puskesmas');

            $table->integer('jumlah_ibu_hamil')->default(0);

            $table->integer('td1')->default(0);
            $table->decimal('td1_persen', 5, 1)->default(0); 

            $table->integer('td2')->default(0);
            $table->decimal('td2_persen', 5, 1)->default(0);

            $table->integer('td3')->default(0);
            $table->decimal('td3_persen', 5, 1)->default(0);

            $table->integer('td4')->default(0);
            $table->decimal('td4_persen', 5, 1)->default(0);

            $table->integer('td5')->default(0);
            $table->decimal('td5_persen', 5, 1)->default(0);

            $table->integer('td2_plus')->default(0);
            $table->decimal('td2_plus_persen', 5, 1)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imunisasi_td_ibu_hamils');
    }
};
