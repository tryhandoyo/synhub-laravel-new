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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pendek');
            $table->string('slug');
            $table->string('judul_panjang');
            $table->string('subjudul');
            $table->text('deskripsi');
            $table->string('foto');
            $table->decimal('harga');
            $table->enum('satuan',['jam','hari']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
