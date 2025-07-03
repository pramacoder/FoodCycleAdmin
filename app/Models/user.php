<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // Nama tabel di database
    protected $fillable = ['name', 'email', 'password']; // Kolom yang dapat diisi massal

    // Relasi dengan model notifikasi (jika ada)
    public function notifikasi()
    {
        return $this->hasMany('App\Models\notifikasi', 'user_id');
    }
    // Relasi dengan model chat (jika ada)
    public function chat()
    {
        return $this->hasMany('App\Models\chat', 'user_id');
    }
    // Relasi dengan model transaksi (jika ada)
    public function transaksi()
    {
        return $this->hasMany('App\Models\transaksi', 'user_id');
    }
    // Relasi dengan model produk (jika ada)
    public function produk()
    {
        return $this->hasMany('App\Models\produk', 'user_id');
    }
}

