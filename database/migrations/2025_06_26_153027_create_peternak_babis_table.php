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
        Schema::create('peternak_babis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peternak')->unique();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable(); // Path to the image file
            $table->decimal('rating', 2, 1)->default(0.0); // Rating from 0.0 to 5.0
            $table->boolean('is_active')->default(true); // Status to indicate if the breeder is active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peternak_babis');
    }
};
