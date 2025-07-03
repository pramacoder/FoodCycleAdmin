@extends('layouts.admin')

@section('title', 'Detail Pajak')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Pajak</h1>
        <a href="{{ route('admin.pajak.edit', $pajak->id) }}" 
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-edit mr-2"></i>Edit Pajak
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Informasi Pajak -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pajak</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">ID Pajak:</span>
                    <span class="font-medium">{{ $pajak->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Persentase Pajak:</span>
                    <span class="font-medium text-green-600">{{ $pajak->persentase }}%</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Status:</span>
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $pajak->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($pajak->status) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Dibuat pada:</span>
                    <span class="font-medium">{{ $pajak->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Diperbarui pada:</span>
                    <span class="font-medium">{{ $pajak->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Statistik Penggunaan -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Statistik Penggunaan</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Transaksi:</span>
                    <span class="font-medium">{{ $totalTransaksi ?? 0 }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Pajak Terkumpul:</span>
                    <span class="font-medium text-green-600">Rp {{ number_format($totalPajakTerkumpul ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Rata-rata per Transaksi:</span>
                    <span class="font-medium">Rp {{ number_format($rataPajakPerTransaksi ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Deskripsi Pajak -->
    @if(isset($pajak->deskripsi) && $pajak->deskripsi)
    <div class="mt-6 bg-gray-50 rounded-lg p-4">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Deskripsi</h2>
        <p class="text-gray-600 leading-relaxed">{{ $pajak->deskripsi }}</p>
    </div>
    @endif

    <!-- Riwayat Perubahan -->
    <div class="mt-6 bg-gray-50 rounded-lg p-4">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Riwayat Perubahan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perubahan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Lama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Baru</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($riwayatPerubahan ?? [] as $riwayat)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $riwayat->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $riwayat->jenis_perubahan }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $riwayat->nilai_lama }}%</td>
                        <td class="px-4 py-2 text-sm text-green-600 font-medium">{{ $riwayat->nilai_baru }}%</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            Belum ada riwayat perubahan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection