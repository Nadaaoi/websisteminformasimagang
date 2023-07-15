<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('user_id');
            // $table->bigInteger('pic_id');
            $table->bigInteger('PEMBIMBING_id');
            $table->integer('is_submit')->default(0);
            $table->integer('penempatan')->nullable();
            $table->integer('kehadiran')->nullable();
            $table->integer('kedisplinan')->nullable();
            $table->integer('kejujuran')->nullable();
            $table->integer('penyelesaian_tugas')->nullable();
            $table->integer('tanggung_jawab')->nullable();
            $table->integer('kreativitas')->nullable();
            $table->integer('etika')->nullable();
            $table->string('nilai_rata_rata')->nullable();
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
