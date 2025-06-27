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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul'); // Field to store the title of the notification
            $table->text('isi'); // Field to store the content of the notification
            $table->boolean('is_read')->default(false); // Field to indicate if the notification
            $table->timestamp('dibaca_pada')->nullable(); // Field to store the timestamp
            $table->string('target')->default('all'); // Field to indicate the target of the notification, e.g., 'all', 'user', 'admin'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
