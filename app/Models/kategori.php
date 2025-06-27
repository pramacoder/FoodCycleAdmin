<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Produk; // Pastikan untuk mengimpor model Produk jika diperlukan
class kategori extends Model
{
    protected $table = 'kategori'; // Nama tabel di database
    protected $fillable = ['nama_kategori', 'deskripsi']; // Kolom yang dapat diisi massal

    // Relasi dengan model Produk (jika ada)
    public function produk()
    {
        return $this->hasMany('App\Models\Produk', 'kategori_id');
    }
}
