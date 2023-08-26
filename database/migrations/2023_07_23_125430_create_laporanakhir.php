<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanAkhir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporanakhir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->integer('NPM')->nullable();
            $table->string('namapembimbing')->nullable();
            $table->string('laporanakhir')->nullable();
            $table->string('sertifikat')->nullable;
            $table->string('nilai')->nullable;
            $table->string('status_laporan')->nullable;
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Create foreign key for pembimbing_id with condition based on role
            // $table->foreign('pembimbing_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('bimbingan');
    }
}