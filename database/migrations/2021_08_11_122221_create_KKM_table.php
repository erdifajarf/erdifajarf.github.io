<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKKMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KKM', function (Blueprint $table) {
            $table->increments('id_KKM');
            $table->unsignedInteger('id_sekolah')->nullable();
            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah');
            $table->unsignedInteger('id_mata_pelajaran')->nullable();
            $table->foreign('id_mata_pelajaran')->references('id_mata_pelajaran')->on('mata_pelajaran');
            $table->double('101_KKM');
            $table->double('102_KKM');
            $table->double('111_KKM');
            $table->double('112_KKM');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('KKM');
    }
}
