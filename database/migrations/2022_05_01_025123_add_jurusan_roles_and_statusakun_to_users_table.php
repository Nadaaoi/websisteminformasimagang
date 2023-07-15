<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJurusanRolesAndStatusakunToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('roles')->after('email')->default('USER');
            $table->string('npm')->after('name')->nullable();
            $table->string('DataProgramStudi')->after('name')->nullable();
            $table->string('tahunmasuk')->after('name')->nullable();
            $table->string('status_akun')->after('roles')->default('TERDAFTAR');
            $table->string('fakultas_id')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roles');
            // $table->dropColumn('jurusan');
            $table->dropColumn('status_akun');
            $table->dropColumn('slug');
            $table->dropColumn('unit_kerja');
        });
    }
}
