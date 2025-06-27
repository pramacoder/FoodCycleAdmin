<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $table = 'pembayarans'; // Nama tabel di database
    protected $fillable = ['status_pembayaran', 'metode_pembayaran', 'tanggal_pembayaran']; // Kolom yang dapat diisi massal

    // Relasi dengan model Transaksi (jika ada)
    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'transaksi_id');
    }
}
