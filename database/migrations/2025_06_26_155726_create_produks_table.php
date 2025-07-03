<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('hotel_restoran_id');
            $table->decimal('harga', 10, 2);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('hotel_restoran_id')->references('id')->on('hotel_restorans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};