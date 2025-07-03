@extends('layout.apps')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Kategori</h2>

<div class="mb-4">
    <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Kategori</a>
</div>

<table class="min-w-full table-auto">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Nama Kategori</th>
            <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td class="border px-4 py-2">{{ $category->id }}</td>
            <td class="border px-4 py-2">{{ $category->nama_kategori }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
