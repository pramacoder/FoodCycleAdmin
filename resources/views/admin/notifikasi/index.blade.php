@extends('layouts.admin')

@section('title', 'Manajemen Notifikasi')

@section('content')
<div class="bg-white rounded-lg shadow-md">
    <div class="flex items-center justify-between p-6 border-b">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Notifikasi</h1>
        <a href="{{ route('admin.notifikasis.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Kirim Notifikasi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded m-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="p-6 border-b bg-gray-50">
        <form method="GET" action="{{ route('admin.notifikasis.index') }}" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari berdasarkan judul atau isi notifikasi..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select name="target" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Target</option>
                    <option value="all" {{ request('target') == 'all' ? 'selected' : '' }}>Semua User</option>
                    <option value="user" {{ request('target') == 'user' ? 'selected' : '' }}>User Tertentu</option>
                    <option value="admin" {{ request('target') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
            <a href="{{ route('admin.notifikasis.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-refresh mr-2"></i>Reset
            </a>
        </form>
    </div>

    <!-- Stats Section -->
    <div class="p-6 border-b">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-blue-100 p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-bell text-blue-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Total Notifikasi</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalNotifikasi ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-100 p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Sudah Dibaca</p>
                        <p class="text-2xl font-bold text-green-600">{{ $dibaca ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-100 p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-clock text-yellow-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Belum Dibaca</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $belumDibaca ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-purple-100 p-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-calendar-day text-purple-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">Hari Ini</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $hariIni ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerima</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($notifikasis as $notifikasi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $notifikasi->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($notifikasi->user)
                                {{ $notifikasi->user->nama }}
                                <br>
                                <span class="text-xs text-gray-500">{{ $notifikasi->user->email }}</span>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="font-medium">{{ $notifikasi->judul }}</div>
                            <div class="text-gray-500 text-xs mt-1">
                                {{ Str::limit($notifikasi->isi, 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($notifikasi->target === 'all') bg-blue-100 text-blue-800
                                @elseif($notifikasi->target === 'user') bg-green-100 text-green-800
                                @elseif($notifikasi->target === 'admin') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($notifikasi->target) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($notifikasi->is_read)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Dibaca
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>Belum Dibaca
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ $notifikasi->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $notifikasi->created_at->format('H:i') }}</div>
                            @if($notifikasi->dibaca_pada)
                                <div class="text-xs text-green-600 mt-1">
                                    Dibaca: {{ $notifikasi->dibaca_pada->format('d M Y H:i') }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.notifikasis.show', $notifikasi->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition duration-200">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.notifikasis.edit', $notifikasi->id) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 transition duration-200">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.notifikasis.destroy', $notifikasi->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-bell-slash text-4xl text-gray-300 mb-2"></i>
                                <p>Belum ada notifikasi yang ditemukan</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($notifikasis->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $notifikasis->links() }}
        </div>
    @endif
</div>
@endsection