<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis'; // Nama tabel di database
    protected $fillable = ['jumlah', 'jenis_transaksi', 'tanggal']; // Kolom yang dapat diisi massal

    // Relasi dengan model Income (jika ada)
        public function income()
        {
            return $this->hasMany('App\Models\Income', 'transaksi_id');
        }
    // Relasi dengan model Pembayaran (jika ada)
    public function pembayaran()
    {
        return $this->hasMany('App\Models\Pembayaran', 'pembayaran_id');
    }

    // Relasi dengan model User (jika ada)
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    // Relasi dengan model Produk (jika ada)
    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_id');
    }
    // Relasi dengan model Peternak_babi (jika ada)
    public function peternak_babi()
    {
        return $this->belongsTo('App\Models\Peternak_babi', 'peternak_babi_id');
    }
    // Relasi dengan model Hotel_restoran (jika ada)
    public function hotel_restoran()
    {
        return $this->belongsTo('App\Models\Hotel_restoran', 'hotel_restoran_id');
    }
    
}
