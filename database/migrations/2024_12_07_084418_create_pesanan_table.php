<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan');
            $table->biginteger('user_id');
            $table->biginteger('produk_id');
            $table->string('perusahaan');
            $table->integer('jumlah_orang');
            $table->date('tanggal_1');
            $table->date('tanggal_2');
            $table->time('jam_1');
            $table->time('jam_2');
            $table->string('keterangan');
            $table->enum('status',['1','2','3','4']);
            $table->integer('durasi');
            $table->integer('total');
            $table->biginteger('bayar_id');
            $table->string('bukti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
