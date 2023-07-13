<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('kebutuhan_id')->nullable();
            $table->integer('PEMBIMBING_id')->nullable();
            $table->integer('penempatan_id')->nullable();
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
        Schema::dropIfExists('rencana_kegiatans');
    }
}
