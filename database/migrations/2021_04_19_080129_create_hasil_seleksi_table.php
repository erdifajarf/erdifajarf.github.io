<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilSeleksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_seleksi', function (Blueprint $table) {
            $table->bigIncrements('no');
            $table->bigInteger('no_pmb');
            $table->String('nama');
            $table->String('asal_sekolah');
            $table->bigInteger('peringkat_sekolah');
            $table->float('rata_rata_nilai');
            $table->float('rata_rata_ipk');
            $table->decimal('bobot_akhir', 10, 6);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_seleksi');
    }
}
