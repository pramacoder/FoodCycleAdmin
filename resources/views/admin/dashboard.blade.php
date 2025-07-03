@extends('layouts.admin')

@section('title', 'Dashboard - FoodCycle Admin')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
    <p class="text-gray-600 mt-2">Selamat datang di panel admin FoodCycle</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-blue-600"></i>
            </div>
            <span class="text-sm text-gray-500">Total Users</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ $totalUsers ?? 0 }}</h3>
        <p class="text-sm text-green-600 mt-2">
            <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
        </p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-exchange-alt text-green-600"></i>
            </div>
            <span class="text-sm text-gray-500">Total Transaksi</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ $totalTransaksi ?? 0 }}</h3>
        <p class="text-sm text-green-600 mt-2">
            <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
        </p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-tags text-yellow-600"></i>
            </div>
            <span class="text-sm text-gray-500">Total Kategori</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ $totalKategori ?? 0 }}</h3>
        <p class="text-sm text-gray-600 mt-2">
            <i class="fas fa-minus"></i> Tidak ada perubahan
        </p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <i class="fas fa-bell text-purple-600"></i>
            </div>
            <span class="text-sm text-gray-500">Notifikasi Terkirim</span>
        </div>
        <h3 class="text-2xl font-bold text-gray-800">{{ $totalNotifikasi ?? 0 }}</h3>
        <p class="text-sm text-green-600 mt-2">
            <i class="fas fa-arrow-up"></i> 25% dari bulan lalu
        </p>
    </div>
</div>

<!-- Recent Transactions -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h3 class="text-xl font-semibold text-gray-800">Transaksi Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentTransaksi ?? [] as $transaksi)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $transaksi->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaksi->user->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($transaksi->status == 'completed') bg-green-100 text-green-800
                            @elseif($transaksi->status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $transaksi->tanggal_transaksi->format('d M Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
