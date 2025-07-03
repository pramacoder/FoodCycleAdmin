<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peternak_babi extends Model
{
    protected $table = 'peternak_babis'; // Nama tabel di database
    protected $fillable = ['nama_peternak', 'alamat', 'telepon']; // Kolom yang dapat diisi massal

    // Relasi dengan model Produk (jika ada)
    public function produk()
    {
        return $this->hasMany('App\Models\produk', 'produk_id');
    }

    // Relasi dengan model Transaksi (jika ada)
    public function transaksi()
    {
        return $this->hasMany('App\Models\transaksi', 'transaksi_id');
    }
    // Relasi dengan model Pembayaran (jika ada)
    public function pembayaran()
    {
        return $this->hasMany('App\Models\pembayaran', 'pembayaran_id');
    }
    // Relasi dengan model Notifikasi (jika ada)
    public function notifikasi()
    {
        return $this->hasMany('App\Models\notifikasi', 'notifikasi_id');
    }
    // Relasi dengan model Chat (jika ada)
    public function chat()
    {
        return $this->hasMany('App\Models\chat', 'chat_id');
    }
    // Relasi dengan model User (jika ada)
    public function user()
    {
        return $this->belongsTo('App\Models\user', 'user_id');
    }
    
}
