<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('siswa', function (Blueprint $table) {
            $table->increments('id_siswa');
            $table->integer('nis');
            $table->string('nama_siswa');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('jenis_kelamin');
            $table->string('alamat');
            $table->string('foto_siswa');
            $table->string('username');
            $table->string('password');
            $table->foreignId('id_kelas');
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
