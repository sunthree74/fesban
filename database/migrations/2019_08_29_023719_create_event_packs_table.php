<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_packs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('klub_id')->index();
            $table->enum('photo', ['belum', 'sudah'])->default('belum');
            $table->enum('snack', ['belum', 'sudah'])->default('belum');
            $table->enum('registrasi', ['belum', 'sudah'])->default('belum');
            $table->string('judul_lagu')->default('belum ada judul');
            $table->string('nomor_urut',5)->default('0');
            $table->string('mp3_record')->nullable();
            $table->enum('status', ['belum datang', 'menunggu', 'tampil', 'sudah tampil'])->default('belum datang');
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
        Schema::dropIfExists('event_packs');
    }
}
