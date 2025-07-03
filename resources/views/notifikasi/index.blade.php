@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Notifikasi</h2>

<div class="mb-4">
    <a href="{{ route('notifications.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Notifikasi</a>
</div>

<table class="min-w-full table-auto">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Judul</th>
            <th class="px-4 py-2 text-left">Isi</th>
            <th class="px-4 py-2 text-left">Target</th>
            <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($notifications as $notification)
        <tr>
            <td class="border px-4 py-2">{{ $notification->id }}</td>
            <td class="border px-4 py-2">{{ $notification->judul }}</td>
            <td class="border px-4 py-2">{{ $notification->isi }}</td>
            <td class="border px-4 py-2">{{ $notification->target }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('notifications.edit', $notification->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline;">
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
