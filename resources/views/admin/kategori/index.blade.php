@extends('layouts.admin')

@section('title', 'Kategori - FoodCycle Admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Kategori</h2>
        <p class="text-gray-600 mt-2">Kelola kategori produk</p>
    </div>
    <a href="{{ route('admin.kategoris.create') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">
        <i class="fas fa-plus"></i>
        Tambah Kategori
    </a>
</div>

<!-- Categories Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($kategoris as $kategori)
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-tag text-green-600"></i>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <h3 class="text-lg font-semibold text-gray-800">{{ $kategori->nama_kategori }}</h3>
        <p class="text-sm text-gray-500 mt-2">Dibuat: {{ $kategori->created_at->format('d M Y') }}</p>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
        <p class="text-gray-500">Belum ada kategori. <a href="{{ route('admin.kategoris.create') }}" class="text-green-600 hover:text-green-700">Tambah kategori baru</a></p>
    </div>
    @endforelse
</div>
@endsection
