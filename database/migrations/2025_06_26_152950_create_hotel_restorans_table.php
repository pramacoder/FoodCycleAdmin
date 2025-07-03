<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_restorans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hotel_restoran');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_restorans');
    }
};