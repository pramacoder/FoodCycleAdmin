@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
        <a href="{{ route('admin.kategoris.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda:
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                Nama Kategori <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="nama_kategori" 
                   name="nama_kategori" 
                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_kategori') border-red-500 @enderror"
                   placeholder="Masukkan nama kategori"
                   required>
            @error('nama_kategori')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi Kategori</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-600">ID:</span>
                    <span class="font-medium">{{ $kategori->id }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Dibuat:</span>
                    <span class="font-medium">{{ $kategori->created_at->format('d M Y H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Diperbarui:</span>
                    <span class="font-medium">{{ $kategori->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('admin.kategoris.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                <i class="fas fa-save mr-2"></i>Perbarui
            </button>
        </div>
    </form>
</div>
@endsection