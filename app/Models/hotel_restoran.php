<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel_restoran extends Model
{
    protected $table = 'hotel_restorans'; // Nama tabel di database
    protected $fillable = ['nama_hotel', 'alamat', 'nomor_telepon', 'email']; // Kolom yang dapat diisi massal

    // Relasi dengan model Produk (jika ada)
    public function produk()
    {
        return $this->hasMany('App\Models\produk', 'hotel_restoran_id');
    }
    // Relasi dengan model chat
    public function chat()
    {
        return $this->hasMany('App\Models\chat', 'hotel_restoran_id');
    }
    // Relasi dengan model transaksi (jika ada)
    public function transaksi()
    {
        return $this->hasMany('App\Models\transaksi', 'hotel_restoran_id');
    }
    // Relasi dengan model pembayaran (jika ada)
    public function pembayaran()
    {
        return $this->hasMany('App\Models\pembayaran', 'hotel_restoran_id');
    }
    // Relasi dengan model notifikasi (jika ada)
    public function notifikasi()
    {
        return $this->hasMany('App\Models\notifikasi', 'hotel_restoran_id');
    }
    // Relasi dengan model user (jika ada)
    public function user()
    {
        return $this->belongsTo('App\Models\user', 'user_id');
    }
}
