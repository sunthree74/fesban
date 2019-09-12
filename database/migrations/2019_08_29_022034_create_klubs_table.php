<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKlubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('grup_number')->unique();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->string('foto', 255)->nullable()->default('no-photo.jpg');
            $table->text('alamat')->nullable();
            $table->string('nohp');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('klubs');
    }
}
