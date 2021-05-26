<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->increments('id_nilai');
            $table->unsignedInteger('id_siswa')->nullable();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa');
            $table->unsignedInteger('id_mata_pelajaran')->nullable();
            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('mata_pelajaran');
            $table->double('101_KKM');
            $table->double('101_p');
            $table->double('101_t');
            $table->double('102_KKM');
            $table->double('102_p');
            $table->double('102_t');
            $table->double('111_KKM');
            $table->double('111_p');
            $table->double('111_t');
            $table->double('112_KKM');
            $table->double('112_p');
            $table->double('112_t');
   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai');
    }
}
