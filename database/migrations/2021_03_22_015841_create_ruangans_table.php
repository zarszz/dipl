<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_ruangan')->nullable(true);
            $table->string('kode_ruangan')->nullable(true);
            /**
             * Definisi relasi antara ruangan dan gudang
             */
            $table->unsignedBigInteger('kode_gudang');
            $table->foreign('kode_gudang')
                  ->references('id')
                  ->on('gudangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('ruangans');
    }
}
