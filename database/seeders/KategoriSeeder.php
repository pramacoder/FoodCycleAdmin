<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder; 

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'sayur', 'deskripsi' => 'Kategori untuk produk sayur'],
            ['nama_kategori' => 'buah', 'deskripsi' => 'Kategori untuk produk buah'],
            ['nama_kategori' => 'tulang', 'deskripsi' => 'Kategori untuk produk tulang'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}