<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins'; // Nama tabel di database
    protected $fillable = ['name', 'email', 'password']; // Kolom yang dapat diisi massal

    // Relasi dengan model chat
    public function chat()
    {
        return $this->hasMany('App\Models\chat', 'chat_id');
    }
    // Relasi dengan model transaksi (jika ada)
    public function transaksi()
    {
        return $this->hasMany('App\Models\transaksi', 'transaksi_id');
    }
}
