<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemaganganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pemagangans', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->bigInteger('user_id');
            $table->string('nama');
            $table->string('npm')->unique();
            $table->date('tanggalpengajuan');
            $table->string('fakultas');
            $table->string('DataProgramStudi');
            $table->integer('tahunmasuk');
            $table->string('jenjangpendidikan');
            $table->string('kelas');
            $table->float('ipk');
            $table->integer('semester');
            $table->bigInteger('nohp');
            $table->string('email')->unique();
            $table->text('programmagang')->nullable();
            $table->string('namaperusahaan')->nullable();
            $table->string('posisi')->nullable();
            $table->date('tanggalmulai')->nullable();
            $table->date('tanggalselesai')->nullable();
            $table->string('durasimagang')->nullable();
            $table->string('alasanbelummagang')->nullable();
            $table->string('buktipenerimaan')->nullable();
            $table->string('transkrip_nilai');
            $table->string('kartumahasiswa');
            $table->softDeletes();
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
        Schema::dropIfExists('Pemagangans');
    }
}
