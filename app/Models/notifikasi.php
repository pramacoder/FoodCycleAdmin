<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class notifikasi extends Model
{
    protected $table = 'notifikasi'; // Nama tabel di database
    protected $fillable = ['judul', 'isi', 'status']; // Kolom yang dapat diisi massal

    // Relasi dengan model User (jika ada)
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    // Relasi dengan model hotel_restoran (jika ada)
    public function hotel_restoran()
    {
        return $this->belongsTo('App\Models\hotel_restoran', 'hotel_restoran_id');
    }
    // Relasi dengan model peternak_babi (jika ada)
    public function peternak_babi()
    {
        return $this->belongsTo('App\Models\peternak_babi', 'peternak_babi_id');
    }
}
