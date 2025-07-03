<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $table = 'chats'; // Nama tabel di database
    protected $fillable = ['user_id', 'message', 'created_at']; // Kolom yang dapat diisi massal

    // Relasi dengan model User (jika ada)
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
