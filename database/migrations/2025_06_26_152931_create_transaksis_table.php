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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('hotel_restoran_id')->constrained('hotel_restorans')->onDelete('cascade');
            $table->foreignId('peternak_babi_id')->constrained('peternak_babis')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->string('status')->default('pending'); // 'pending', 'completed', 'cancelled'
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
