<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('klub_id')->index();
            $table->string('judul_lagu')->nullable();
            $table->string('jali_vokal')->default(0);
            $table->string('jali_adab')->default(0);
            $table->string('jali_banjari')->default(0);
            $table->string('khofi_vokal')->default(0);
            $table->string('khofi_adab')->default(0);
            $table->string('khofi_banjari')->default(0);
            $table->string('catatan_vokal')->default('tidak ada catatan');
            $table->string('catatan_adab')->default('tidak ada catatan');
            $table->string('catatan_banjari')->default('tidak ada catatan');
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
        Schema::dropIfExists('penilaians');
    }
}
