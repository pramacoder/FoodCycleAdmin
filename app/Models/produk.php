<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produk'; // Nama tabel di database
    protected $fillable = ['nama_produk', 'harga', 'stok', 'kategori_id']; // Kolom yang dapat diisi massal

    // Relasi dengan model Kategori (jika ada)
    public function kategori()
    {
        return $this->belongsTo('App\Models\kategori', 'kategori_id');
    }
    // Relasi dengan model Transaksi (jika ada)
    public function transaksi()
    {
        return $this->hasMany('App\Models\transaksi', 'produk_id');
    }
}
