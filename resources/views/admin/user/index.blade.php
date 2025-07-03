@extends('layouts.admin')

@section('title', 'Users - FoodCycle Admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Users</h2>
        <p class="text-gray-600 mt-2">Kelola data pengguna aplikasi</p>
    </div>
</div>

<!-- Search and Filter -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4">
        <input type="text" name="search" placeholder="Cari nama atau email..." 
               value="{{ request('search') }}"
               class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        <select name="tipe_pengguna" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            <option value="">Semua Tipe</option>
            <option value="user" {{ request('tipe_pengguna') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('tipe_pengguna') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            <i class="fas fa-search mr-2"></i>Cari
        </button>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telp</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $user->tipe_pengguna == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->tipe_pengguna) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->no_telp ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="max-w-xs truncate" title="{{ $user->alamat }}">
                            {{ $user->alamat ?? '-' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t">
        {{ $users->links() }}
    </div>
</div>
@endsection
