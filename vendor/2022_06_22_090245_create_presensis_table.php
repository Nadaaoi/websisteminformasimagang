<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->bigInteger('user_id');
            $table->string('presensi');
            $table->text('kegiatan');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamp('waktu');
            $table->string('feedback')->nullable();
            $table->string('jenis_program_magang')->nullable();
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
        Schema::dropIfExists('presensis');
    }
}
