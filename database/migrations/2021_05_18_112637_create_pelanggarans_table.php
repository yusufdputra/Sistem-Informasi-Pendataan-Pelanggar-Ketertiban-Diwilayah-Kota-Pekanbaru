<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->id(); 
            $table->string('no_ktp');
            $table->string('nama');
            $table->string('ttl');
            $table->enum('jns_kelamin', ['lk', 'pr']);
            $table->string('agama');
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->string('nomor_hp');
            $table->bigInteger('nama_perda');
            $table->string('pelanggaran');
            $table->string('sangsi');
            $table->string('lokasi');
            $table->text('keterangan');
            $table->string('ktp_path');
            $table->string('sangsi_path');
            $table->boolean('status');
            $table->bigInteger('id_petugas');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggarans');
    }
}
