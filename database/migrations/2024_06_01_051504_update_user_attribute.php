<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('nik')->nullable();
            $table->string('negara')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('role')->default('USER')->nullable();
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
            $table->renameColumn('nama_depan', 'name');
            $table->renameColumn('nama_belakang', 'last_name');
            $table->dropColumn(['nik', 'negara', 'provinsi', 'alamat', 'telepon']);
            $table->string('role')->default('USER')->change();
        });
    }
}
