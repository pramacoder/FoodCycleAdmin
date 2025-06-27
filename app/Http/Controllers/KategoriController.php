<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allkategoris = Kategori::all();
        return view('kategori.index', ['allkategoris' => $allkategoris]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat kategori baru
        return view('kategori.create'); // Pastikan ada view kategori.create untuk menampilkan form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);
        // Validasi data yang diterima dari form
        // Misalnya, nama_kategori harus diisi dan maksimal 20 karakter
        // Deskripsi boleh kosong
        // Simpan data kategori baru ke database
        // Gunakan model kategori untuk menyimpan data
        // Pastikan untuk mengimpor model kategori di bagian atas file ini
        // Contoh:
        // $kategori = new Kategori();
        // $kategori->nama_kategori = $request->nama_kategori;
        // $kategori->deskripsi = $request->deskripsi;
        // $kategori->save();
        Kategori::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        // Menampilkan detail kategori tertentu
        // Anda bisa mengirim data kategori ke view untuk ditampilkan
        // Contoh:
        // return view('kategori.show', compact('kategori'));
        return view('kategori.show', ['kategori' => $kategori]); // Mengirim data kategori ke view kategori.show
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        // Menampilkan form untuk mengedit kategori tertentu
        // Anda bisa mengirim data kategori ke view untuk ditampilkan
        // Contoh:
        // return view('kategori.edit', compact('kategori'));
        return view('kategori.edit', ['kategori' => $kategori]); // Mengirim data kategori ke view kategori.edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:20',
            'deskripsi' => 'nullable|string',
        ]);
        // Validasi data yang diterima dari form
        // Misalnya, nama_kategori harus diisi dan maksimal 20 karakter
        // Deskripsi boleh kosong
        // Update data kategori yang sudah ada di database
        // Gunakan model kategori untuk memperbarui data
        $kategori->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // Hapus kategori dari database
        // Pastikan untuk menghapus data yang sesuai dengan id kategori yang diberikan
        // Contoh:
        // $kategori->delete();
        $kategori->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
