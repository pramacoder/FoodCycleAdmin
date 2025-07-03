@extends('layouts.admin')

@section('title', 'Manajemen Pajak')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manajemen Pajak</h1>
            <p class="text-gray-600 mt-2">Kelola pengaturan pajak untuk sistem FoodCycle</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.transaksi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Transaksi
            </a>
            <a href="{{ route('admin.pajak.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pajak
            </a>
        </div>
    </div>

    <!-- Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Pajak</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalPajak ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-percentage text-blue-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pajak Aktif</p>
                    <p class="text-2xl font-bold text-green-600">{{ $pajakAktif ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Rata-rata Pajak</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $rataRataPajak ?? 0 }}%</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calculator text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Pajak Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Daftar Pajak</h2>
                <div class="flex space-x-3">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari pajak..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pajak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pajaks as $pajak)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">#{{ $pajak->id }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-percentage text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $pajak->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $pajak->deskripsi ?? 'Tidak ada deskripsi' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-lg font-bold text-green-600">{{ $pajak->persentase }}%</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full font-medium bg-gray-100 text-gray-800">
                                {{ ucfirst($pajak->tipe ?? 'Umum') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full font-medium
                                @if($pajak->status == 'aktif') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($pajak->status ?? 'Aktif') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pajak->created_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $pajak->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.pajak.edit', $pajak->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="toggleStatus({{ $pajak->id }})" class="text-yellow-600 hover:text-yellow-900" title="Toggle Status">
                                    <i class="fas fa-toggle-{{ $pajak->status == 'aktif' ? 'on' : 'off' }}"></i>
                                </button>
                                <button onclick="deletePajak({{ $pajak->id }})" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-percentage text-4xl text-gray-300 mb-2"></i>
                                <p>Tidak ada pajak ditemukan</p>
                                <a href="{{ route('admin.pajak.create') }}" class="mt-2 text-blue-600 hover:text-blue-800">
                                    Tambah pajak pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pajaks->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pajaks->links() }}
        </div>
        @endif
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1">
                <i class="fas fa-info-circle text-blue-600"></i>
            </div>
            <div>
                <h3 class="font-semibold text-blue-900">Informasi Pajak</h3>
                <div class="mt-2 text-sm text-blue-700 space-y-1">
                    <p>• Pajak akan diterapkan secara otomatis pada setiap transaksi</p>
                    <p>• Hanya pajak dengan status "Aktif" yang akan digunakan dalam perhitungan</p>
                    <p>• Persentase pajak dapat diubah sewaktu-waktu</p>
                    <p>• Pajak default adalah 5% untuk semua transaksi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleStatus(pajakId) {
    if (confirm('Apakah Anda yakin ingin mengubah status pajak ini?')) {
        fetch(`/admin/pajak/${pajakId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan saat mengubah status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengubah status');
        });
    }
}

function deletePajak(pajakId) {
    if (confirm('Apakah Anda yakin ingin menghapus pajak ini? Tindakan ini tidak dapat dibatalkan.')) {
        fetch(`/admin/pajak/${pajakId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan saat menghapus pajak');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus pajak');
        });
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});
</script>
@endsection