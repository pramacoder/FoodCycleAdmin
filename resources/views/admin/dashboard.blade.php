@extends('layouts.admin')

@section('title', 'Dashboard - FoodCycle Admin')

@section('content')
<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Dashboard
            </h1>
            <p class="text-gray-600 mt-2 text-lg">Selamat datang kembali! Berikut adalah ringkasan aktivitas FoodCycle hari ini.</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>
</div>

<!-- Stats Cards with Animations -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Users Card -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold">{{ $totalUsers ?? 0 }}</div>
                <div class="text-blue-100 text-sm">Total Users</div>
            </div>
        </div>
        <div class="flex items-center text-blue-100">
            <i class="fas fa-arrow-up mr-1"></i>
            <span class="text-sm">+12% dari bulan lalu</span>
        </div>
        <div class="mt-4 w-full bg-white bg-opacity-20 rounded-full h-2">
            <div class="bg-white h-2 rounded-full" style="width: 75%"></div>
        </div>
    </div>

    <!-- Transactions Card -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-exchange-alt text-2xl"></i>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold">{{ $totalTransaksi ?? 0 }}</div>
                <div class="text-green-100 text-sm">Transaksi</div>
            </div>
        </div>
        <div class="flex items-center text-green-100">
            <i class="fas fa-arrow-up mr-1"></i>
            <span class="text-sm">+8% dari bulan lalu</span>
        </div>
        <div class="mt-4 w-full bg-white bg-opacity-20 rounded-full h-2">
            <div class="bg-white h-2 rounded-full" style="width: 65%"></div>
        </div>
    </div>

    <!-- Categories Card -->
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-tags text-2xl"></i>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold">{{ $totalKategori ?? 0 }}</div>
                <div class="text-yellow-100 text-sm">Kategori</div>
            </div>
        </div>
        <div class="flex items-center text-yellow-100">
            <i class="fas fa-minus mr-1"></i>
            <span class="text-sm">Stabil</span>
        </div>
        <div class="mt-4 w-full bg-white bg-opacity-20 rounded-full h-2">
            <div class="bg-white h-2 rounded-full" style="width: 45%"></div>
        </div>
    </div>

    <!-- Notifications Card -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-bell text-2xl"></i>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold">{{ $totalNotifikasi ?? 0 }}</div>
                <div class="text-purple-100 text-sm">Notifikasi</div>
            </div>
        </div>
        <div class="flex items-center text-purple-100">
            <i class="fas fa-arrow-up mr-1"></i>
            <span class="text-sm">+25% dari bulan lalu</span>
        </div>
        <div class="mt-4 w-full bg-white bg-opacity-20 rounded-full h-2">
            <div class="bg-white h-2 rounded-full" style="width: 85%"></div>
        </div>
    </div>
</div>

<!-- Charts and Analytics Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Revenue Chart -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Pendapatan Bulanan</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-lg">7D</button>
                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">30D</button>
                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">90D</button>
            </div>
        </div>
        <div class="h-64 flex items-end justify-between space-x-2">
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 60%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 80%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 45%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 90%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 70%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 85%"></div>
            <div class="flex-1 bg-gradient-to-t from-blue-500 to-blue-300 rounded-t-lg" style="height: 55%"></div>
        </div>
        <div class="flex justify-between mt-4 text-sm text-gray-500">
            <span>Sen</span>
            <span>Sel</span>
            <span>Rab</span>
            <span>Kam</span>
            <span>Jum</span>
            <span>Sab</span>
            <span>Min</span>
        </div>
    </div>

    <!-- Activity Feed -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Aktivitas Terbaru</h3>
        <div class="space-y-4">
            <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-plus text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">User baru mendaftar</p>
                    <p class="text-xs text-gray-500">2 menit yang lalu</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Transaksi berhasil</p>
                    <p class="text-xs text-gray-500">5 menit yang lalu</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-lg">
                <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Stok menipis</p>
                    <p class="text-xs text-gray-500">10 menit yang lalu</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-bell text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Notifikasi terkirim</p>
                    <p class="text-xs text-gray-500">15 menit yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions with Enhanced Design -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-800">Transaksi Terbaru</h3>
            <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">Lihat Semua</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentTransaksi ?? [] as $transaksi)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            #{{ $transaksi->id }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-600 text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->user->nama ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                        Rp {{ number_format($transaksi->total_harga ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                            @if(($transaksi->status ?? '') == 'completed') bg-green-100 text-green-800
                            @elseif(($transaksi->status ?? '') == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            <span class="w-2 h-2 rounded-full mr-1.5
                                @if(($transaksi->status ?? '') == 'completed') bg-green-400
                                @elseif(($transaksi->status ?? '') == 'pending') bg-yellow-400
                                @else bg-red-400
                                @endif"></span>
                            {{ ucfirst($transaksi->status ?? 'unknown') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $transaksi->tanggal_transaksi ? $transaksi->tanggal_transaksi->format('d M Y H:i') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="text-green-600 hover:text-green-900">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 text-lg font-medium">Belum ada transaksi</p>
                            <p class="text-gray-400 text-sm">Transaksi akan muncul di sini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold mb-2">Tambah User</h4>
                <p class="text-blue-100 text-sm mb-4">Daftarkan user baru ke sistem</p>
                <button class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all duration-200">
                    Tambah User
                </button>
            </div>
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-user-plus text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold mb-2">Buat Transaksi</h4>
                <p class="text-green-100 text-sm mb-4">Proses transaksi baru</p>
                <button class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all duration-200">
                    Buat Transaksi
                </button>
            </div>
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-plus text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-semibold mb-2">Kirim Notifikasi</h4>
                <p class="text-purple-100 text-sm mb-4">Kirim notifikasi ke user</p>
                <button class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all duration-200">
                    Kirim Notif
                </button>
            </div>
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-bell text-xl"></i>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Add some interactive animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate stats cards on load
    const cards = document.querySelectorAll('.grid > div');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Simple chart animation
    const chartBars = document.querySelectorAll('.bg-gradient-to-t');
    chartBars.forEach((bar, index) => {
        const height = bar.style.height;
        bar.style.height = '0%';
        setTimeout(() => {
            bar.style.transition = 'height 1s ease';
            bar.style.height = height;
        }, index * 100);
    });
});
</script>
@endpush
