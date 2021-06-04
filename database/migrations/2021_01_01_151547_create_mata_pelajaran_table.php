<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataPelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->increments('id_mata_pelajaran');
            $table->string('nama_mata_pelajaran',20);
   
        });

        DB::table('mata_pelajaran')->insert(
            array(
                ['id_mata_pelajaran' => '1',
                'nama_mata_pelajaran' => 'Bahasa Inggris']
                ,
                ['id_mata_pelajaran' => '2',
                'nama_mata_pelajaran' => 'Matematika'],

            )


        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mata_pelajaran');
    }
}
