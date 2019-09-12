<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('belum diisi');
            $table->string('foto', 255)->default('no-photo.jpg');
            $table->string('nohp')->nullable()->default('belum diisi');
            $table->string('tempat_lahir')->nullable()->default('belum diisi');
            $table->date('tanggal_lahir')->nullable();
            $table->unsignedBigInteger('klub_id')->index();
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
        Schema::dropIfExists('anggotas');
    }
}
