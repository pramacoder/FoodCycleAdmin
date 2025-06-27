<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kategori</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Kategori</h1>
        <div class="mb-4">
            <a href="{{ route('kategori.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Kategori</a>
        </div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama Kategori</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allkategoris as $key => $kategori)
                    <tr>
                        <td class="border px-4 py-2">{{ $kategori->id }}</td>
                        <td class="border px-4 py-2">{{ $kategori->nama_kategori }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>