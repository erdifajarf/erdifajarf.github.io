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
            $table->increments('no');
            $table->integer('no_pmb');
            $table->string('nama',50);
            $table->string('asal_sekolah',50);
            $table->integer('peringkat_sekolah');
            $table->double('rata_rata_nilai');
            $table->double('rata_rata_ipk');
            $table->double('bobot_akhir', 6);

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
