<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBimbinganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->integer('npm');
            $table->date('tanggalpengajuan');
            $table->string('kelas');
            $table->string('programmagang');
            $table->string('namaperusahaan');
            $table->string('posisi');
            $table->string('namapembimbing');
            $table->integer('pertemuan');
            $table->string('deskripsibimbingan');
            $table->string('hasilbimbingan');
            $table->string('tandatanganpembimbing')->nullable();
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