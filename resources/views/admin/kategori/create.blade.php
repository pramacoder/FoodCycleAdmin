@extends('layouts.admin')

@section('title', 'Tambah Kategori - FoodCycle Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.kategoris.index') }}" class="text-green-600 hover:text-green-700 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Kategori
    </a>
    <h2 class="text-3xl font-bold text-gray-800">Tambah Kategori Baru</h2>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('admin.kategoris.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('nama_kategori') border-red-500 @enderror"
                   value="{{ old('nama_kategori') }}" required>
            @error('nama_kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.kategoris.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
