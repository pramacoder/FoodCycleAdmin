<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\transaksi; // Pastikan untuk mengimpor model transaksi jika diperlukan
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    protected $table = 'income'; // Nama tabel di database
    protected $fillable = ['amount', 'source', 'date']; // Kolom yang dapat diisi massal

    // Relasi dengan model transaksi (jika ada)
    public function transaksi()
    {
        return $this->belongsTo('App\Models\transaksi', 'transaksi_id');
    }
}
