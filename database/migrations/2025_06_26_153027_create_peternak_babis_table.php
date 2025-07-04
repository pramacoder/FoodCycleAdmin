<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peternak_babis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peternak');
            $table->text('alamat');
            $table->string('no_telp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peternak_babis');
    }
};
