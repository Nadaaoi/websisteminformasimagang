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
            $table->bigInteger('id_pembimbing')->nullable();
            $table->string('nama');
            $table->string('npm');
            $table->date('tanggalpengajuan');
            $table->string('fakultas');
            $table->string('programstudi');
            $table->integer('tahunmasuk');
            $table->string('jenjangpendidikan');
            $table->string('kelas');
            $table->float('ipk');
            $table->integer('semester');
            $table->bigInteger('nohp');
            $table->string('email');
            $table->text('programmagang')->nullable();
            $table->string('namaperusahaan')->nullable();
            $table->string('posisi')->nullable();
            $table->date('tanggalmulai')->nullable();
            $table->date('tanggalselesai')->nullable();
            $table->string('durasimagang')->nullable();
            $table->string('alasanbelummagang')->nullable();
            $table->string('statuspengajuan')->default('terdaftar')->nullable();
            $table->string('namapembimbing')->nullable();
            $table->string('buktipenerimaan')->nullable();
            $table->string('transkrip_nilai')->nullable();
            $table->string('kartumahasiswa')->nullable();
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
