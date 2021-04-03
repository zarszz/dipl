<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tgl_lahir')->nullable();
            $table->string('password')->nullable();
            $table->longText('alamat')->nullable();
            $table->enum('jenis_kelamin', ['pria', 'wanita', 'yang lain'])->nullable();
            /**
             * role_id
             * 1 = admin
             * 2 = driver
             * 3 = user
             */
            $table->integer('role_id')->nullable();
            $table->char('google_id')->nullable();
            $table->string('email')->unique();
            $table->string('status')->default('unverified');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
