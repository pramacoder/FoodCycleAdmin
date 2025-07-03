<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Firebase;
use Kreait\Firebase\Factory;


class KategoriController extends Controller
{
    // Create category
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories',
        ]);

        $category = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return response()->json($category, 201);
    }

    // Read all categories
    public function index()
    {
        return response()->json(kategori::all());
    }

    // Update category
    public function update(Request $request, Kategori $category)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id,
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return response()->json($category);
    }

    // Delete category
    public function destroy(Kategori $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
