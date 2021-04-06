<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->string('aksi');

            /**
             * Definisi relasi antara audit log dan gudang
             */
            $table->unsignedBigInteger('kode_gudang')->nullable();
            $table->foreign('kode_gudang')
                  ->references('id')
                  ->on('gudangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara audit log dan barang
             */
            $table->unsignedBigInteger('kode_barang')->nullable();
            $table->foreign('kode_barang')
                  ->references('id')
                  ->on('barangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara audit log dan kendaraan
             */
            $table->unsignedBigInteger('kode_kendaraan')->nullable();
            $table->foreign('kode_kendaraan')
                  ->references('id')
                  ->on('kendaraans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            /**
             * Definisi relasi antara audit log dan user
             */
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
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
        Schema::dropIfExists('audit_logs');
    }
}
