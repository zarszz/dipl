<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();

            /**
             * Definisi relasi antara barang dan user
             */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara barang dan gudang
             */
            $table->unsignedBigInteger('kode_gudang');
            $table->foreign('kode_gudang')
                  ->references('id')
                  ->on('gudangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara barang dan ruangan
             */
            $table->unsignedBigInteger('kode_ruangan');
            $table->foreign('kode_ruangan')
                  ->references('id')
                  ->on('ruangans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara barang dan kendaraan
             */
            $table->unsignedBigInteger('kode_kendaraan');
            $table->foreign('kode_kendaraan')
                  ->references('id')
                  ->on('kendaraans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara barang dan kategori
             */
            $table->unsignedBigInteger('kode_kategori');
            $table->foreign('kode_kategori')
                  ->references('id')
                  ->on('kategoris')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');


            $table->string('nama_brg');
            $table->string('jenis_brg');
            $table->unsignedInteger('jumlah_brg');

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
        Schema::dropIfExists('barangs');
    }
}
