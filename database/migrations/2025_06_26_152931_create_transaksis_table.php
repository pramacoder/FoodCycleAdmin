<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Make sure this migration runs after the hotel_restorans table migration.
 * If not, rename this file so its timestamp is after the hotel_restorans migration file.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('transaksis')) {
            Schema::create('transaksis', function (Blueprint $table) {
                $table->id();
                
                // Foreign key references user_id from 'users' table
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                // Foreign key references hotel_restoran_id from 'hotel_restorans' table
                $table->foreignId('hotel_restoran_id')->constrained('hotel_restorans')->onDelete('cascade');
                // Foreign key references peternak_babi_id from 'peternak_babis' table
                $table->foreignId('peternak_babi_id')->constrained('peternak_babis')->onDelete('cascade');
                
                // Foreign key references produk_id from 'produks' table
                $table->foreignId('produks_id')->constrained('produks')->onDelete('cascade');
                
                $table->integer('jumlah');
                $table->decimal('total_harga', 10, 2);
                $table->string('status')->default('pending'); // 'pending', 'completed', 'cancelled'
                $table->timestamp('tanggal_transaksi')->useCurrent();
                $table->decimal('pajak', 5, 2)->default(5.00);
                $table->timestamps();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

