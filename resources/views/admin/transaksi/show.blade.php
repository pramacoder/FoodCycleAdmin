@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Transaksi #{{ $transaksi->id }}</h1>
            <p class="text-gray-600 mt-2">Informasi lengkap transaksi</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.transaksi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
            <button onclick="printTransaksi()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-print mr-2"></i>
                Print
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Transaksi Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Transaksi</h2>
                    <span class="px-3 py-1 text-sm rounded-full font-medium
                        @if($transaksi->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($transaksi->status == 'completed') bg-green-100 text-green-800
                        @elseif($transaksi->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($transaksi->status) }}
                    </span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ID Transaksi</label>
                            <p class="mt-1 text-sm text-gray-900 font-mono">#{{ $transaksi->id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $transaksi->tanggal_transaksi->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $transaksi->jumlah }} unit</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pajak</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $transaksi->pajak }}%</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Harga</label>
                            <p class="mt-1 text-2xl font-bold text-green-600">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1 flex items-center space-x-2">
                                <span class="px-2 py-1 text-xs rounded-full font-medium
                                    @if($transaksi->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($transaksi->status == 'completed') bg-green-100 text-green-800
                                    @elseif($transaksi->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                                @if($transaksi->status == 'pending')
                                <button onclick="updateStatus('completed')" class="text-green-600 hover:text-green-900 text-sm">
                                    <i class="fas fa-check mr-1"></i>Complete
                                </button>
                                <button onclick="updateStatus('cancelled')" class="text-red-600 hover:text-red-900 text-sm">
                                    <i class="fas fa-times mr-1"></i>Cancel
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Info -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Produk</h2>
                <div class="border rounded-lg p-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-utensils text-gray-600 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $transaksi->produk->nama ?? 'N/A' }}</h3>
                            <p class="text-sm text-gray-600">{{ $transaksi->produk->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                            <div class="flex items-center mt-2 space-x-4">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $transaksi->produk->kategori->nama_kategori ?? 'N/A' }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-weight mr-1"></i>
                                    {{ $transaksi->produk->berat ?? 'N/A' }} kg
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-green-600">Rp {{ number_format($transaksi->produk->harga ?? 0, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500">per unit</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Timeline Transaksi</h2>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-plus text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Transaksi Dibuat</p>
                            <p class="text-sm text-gray-500">{{ $transaksi->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($transaksi->status == 'completed')
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Transaksi Selesai</p>
                            <p class="text-sm text-gray-500">{{ $transaksi->updated_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    @elseif($transaksi->status == 'cancelled')
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-times text-red-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Transaksi Dibatalkan</p>
                            <p class="text-sm text-gray-500">{{ $transaksi->updated_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- User Info -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi User</h2>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user text-gray-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">{{ $transaksi->user->nama }}</h3>
                    <p class="text-sm text-gray-600">{{ $transaksi->user->email }}</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Tipe:</span>
                            <span class="text-sm font-medium text-gray-900">{{ ucfirst($transaksi->user->tipe_pengguna) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Telepon:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->user->no_telp ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Alamat:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->user->alamat ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $transaksi->user->id) }}" class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm inline-block">
                        Lihat Detail User
                    </a>
                </div>
            </div>

            <!-- Hotel/Restoran Info -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Hotel/Restoran</h2>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-hotel text-orange-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $transaksi->hotelRestoran->nama ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ $transaksi->hotelRestoran->alamat ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Telepon:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->hotelRestoran->no_telp ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-sm text-gray-500">Email:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->hotelRestoran->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Peternak Info -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Peternak Babi</h2>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-tractor text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $transaksi->peternakBabi->nama ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-600">{{ $transaksi->peternakBabi->alamat ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Telepon:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->peternakBabi->no_telp ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-sm text-gray-500">Email:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $transaksi->peternakBabi->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(newStatus) {
    if (confirm(`Apakah Anda yakin ingin mengubah status transaksi ini menjadi ${newStatus}?`)) {
        fetch(`/admin/transaksi/{{ $transaksi->id }}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: newStatus
            })
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

function printTransaksi() {
    window.print();
}
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style>
@endsection