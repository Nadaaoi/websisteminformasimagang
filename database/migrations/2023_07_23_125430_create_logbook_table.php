<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->date('date');
            $table->enum('status_kehadiran', ['Hadir', 'Tidak hadir']);
            $table->text('deskripsi_tugas')->nullable();
            $table->string('alasan_ketidakhadiran')->nullable();
            $table->timestamps();

            // Tambahkan foreign key constraint untuk menghubungkan dengan tabel pengguna (users)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logbook', function (Blueprint $table) {

            // Hapus foreign key constraint untuk 'user_id'
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('logbook');
    }
}