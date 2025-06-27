<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi'; // Nama tabel di database
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
}
