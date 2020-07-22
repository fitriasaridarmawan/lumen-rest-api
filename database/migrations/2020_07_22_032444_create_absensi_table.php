<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->bigIncrements('id_absensi');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('email')->unique();
            $table->string('address' ,100);
            $table->string('foto_absen',200);
            $table->char('status',1)->comment('0: WFO , 1: WFH , 2: IJIN');
            $table->char('status_det',1)->comment('0: WFO , 1: WFH , 2: IJIN , 3: IJIN 1/2 hari, 4: Sakit, 5: Cuti');
            $table->timestamps();

            // $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
