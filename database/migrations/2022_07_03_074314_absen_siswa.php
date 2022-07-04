<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbsenSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
   {
      Schema::create('absen_siswa', function (Blueprint $table) {
            $table->increments('id_absen');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->string('keterangan');
            $table->foreignId('id_siswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
