<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Hotel_restoran;
use App\Models\Kategori; // Tambahkan import model Kategori
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Peternak_babi;
use App\Models\Produk;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        // data dummy untuk table admin
        $admin = Admin::create([
            'name' => 'Pramajaya',
            'email' => 'Pramajaya456@gmail.com',
            'password' => bcrypt('Pramajaya456'),
        ]);

        // Menambah data dummy untuk tabel users
        $user = User::create([
            'name' => 'Wolly',
            'email' => 'willy@gmail.com',
            'password' => bcrypt('Pramajaya22'),
            'tipe_pengguna' => 'admin',
            'alamat' => 'Jln. Contoh Alamat yahaha No. 123',
            'no_telp' => '081234567890',
            'foto' => 'path/to/image.jpg',
        ]);

        // Menambah data dummy untuk tabel hotel_restorans
        $hotelRestoran = Hotel_restoran::create([
            'nama_hotel_restoran' => 'RestoranTwoZa',
            'alamat' => 'Jl. Contoh Alamat No. 123',
            'no_telp' => '081234567890',
            'email' => 'restoranabc@example.com',
            'deskripsi' => 'Restoran dengan masakan lezat dan suasana nyaman.',
            'gambar' => 'path/to/image.jpg',
            'rating' => 4.5,
            'is_active' => true,
        ]);

        // Menambah data dummy untuk tabel kategori
        $kategori = Kategori::create([
            'nama_kategori' => 'Kategori Dummy',
            // tambahkan field lain jika diperlukan
        ]);

        // Menambah data dummy untuk tabel peternak_babis
        $peternakBabi = Peternak_babi::create([
            'nama_peternak' => 'Peternak Arak Bali',
            'alamat' => 'Jl. Peternak No. 45',
            'no_telp' => '082345678901',
        ]);

        // Menambah data dummy untuk tabel produk
        $produk = Produk::create([
            'nama_produk' => 'Produk ABC',
            'kategori_id' => $kategori->id, // Gunakan ID kategori yang baru dibuat
            'hotel_restoran_id' => $hotelRestoran->id,
            'harga' => $faker->numberBetween(10000, 100000),
        ]);
    }
}