@extends('layouts.admin')

@section('title', 'Detail User - FoodCycle Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-green-600 hover:text-green-700 mb-4 inline-block">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar User
    </a>
    <h2 class="text-3xl font-bold text-gray-800">Detail User</h2>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Dasar</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-sm text-gray-500">ID</label>
                    <p class="text-gray-900">{{ $user->id }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Nama</label>
                    <p class="text-gray-900">{{ $user->nama }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Email</label>
                    <p class="text-gray-900">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Tipe Pengguna</label>
                    <p>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $user->tipe_pengguna == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->tipe_pengguna) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div>
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Kontak</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-sm text-gray-500">No. Telepon</label>
                    <p class="text-gray-900">{{ $user->no_telp ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Alamat</label>
                    <p class="text-gray-900">{{ $user->alamat ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Tanggal Registrasi</label>
                    <p class="text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-500">Terakhir Diperbarui</label>
                    <p class="text-gray-900">{{ $user->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Statistics -->
    <div class="mt-8 pt-8 border-t">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Statistik Pengguna</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">Total Transaksi</p>
                <p class="text-2xl font-bold text-gray-900">{{ $user->transaksis->count() }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">Total Nilai Transaksi</p>
                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($user->transaksis->sum('total_harga'), 0, ',', '.') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-500">Notifikasi Diterima</p>
                <p class="text-2xl font-bold text-gray-900">{{ $user->notifikasis->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection