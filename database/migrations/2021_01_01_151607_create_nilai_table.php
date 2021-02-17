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
            $table->bigIncrements('id_nilai');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa');
            $table->unsignedBigInteger('id_mata_pelajaran')->nullable();
            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('mata_pelajaran');
            $table->double('101');
            $table->double('102');
            $table->double('111');
            $table->double('112');
   
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
