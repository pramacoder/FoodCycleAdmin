@extends('layouts.admin')

@section('title', 'Detail Notifikasi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Notifikasi</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.notifikasis.edit', $notifikasi->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.notifikasis.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Status Badge -->
    <div class="mb-6">
        @if($notifikasi->is_read)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                <i class="fas fa-check-circle mr-2"></i>Sudah Dibaca
            </span>
        @else
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                <i class="fas fa-clock mr-2"></i>Belum Dibaca
            </span>
        @endif
        
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ml-2
            @if($notifikasi->target === 'all') bg-blue-100 text-blue-800
            @elseif($notifikasi->target === 'user') bg-green-100 text-green-800
            @elseif($notifikasi->target === 'admin') bg-purple-100 text-purple-800
            @else bg-gray-100 text-gray-800
            @endif">
            <i class="fas fa-users mr-2"></i>{{ ucfirst($notifikasi->target) }}
        </span>
    </div>

    <!-- Notification Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Isi Notifikasi</h2>
                
                <!-- Notification Preview -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-bell text-blue-500 text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900">
                                {{ $notifikasi->judul }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                {{ $notifikasi->isi }}
                            </div>
                            <div class="text-xs text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $notifikasi->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Raw Content -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <div class="bg-white border border-gray-200 rounded-md p-3">
                            {{ $notifikasi->judul }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Notifikasi</label>
                        <div class="bg-white border border-gray-200 rounded-md p-3">
                            {{ $notifikasi->isi }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Firebase Status -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-blue-800 mb-2">
                    <i class="fas fa-cloud mr-2"></i>Status Firebase
                </h3>
                <div class="text-sm text-blue-700">
                    <p>• Notifikasi telah dikirim ke Firebase</p>
                    <p>• User akan menerima notifikasi push</p>
                    <p>• Status pengiriman: 
                        <span class="font-medium text-green-600">Berhasil</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-1">
            <!-- Recipient Info -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Informasi Penerima</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Target:</span>
                        <span class="text-sm font-medium">{{ ucfirst($notifikasi->target) }}</span>
                    </div>
                    @if($notifikasi->user)
                        <div class="border-t pt-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">User:</span>
                                <span class="text-sm font-medium">{{ $notifikasi->user->nama }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Email:</span>
                                <span class="text-sm text-gray-500">{{ $notifikasi->user->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tipe:</span>
                                <span class="text-sm text-gray-500">{{ ucfirst($notifikasi->user->tipe_pengguna) }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Timeline</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-900">Notifikasi Dibuat</div>
                            <div class="text-xs text-gray-500">{{ $notifikasi->created_at->format('d M Y H:i:s') }}</div>
                        </div>
                    </div>
                    
                    @if($notifikasi->updated_at != $notifikasi->created_at)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">Notifikasi Diperbarui</div>
                                <div class="text-xs text-gray-500">{{ $notifikasi->updated_at->format('d M Y H:i:s') }}</div>
                            </div>
                        </div>
                    @endif
                    
                    @if($notifikasi->dibaca_pada)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900">Notifikasi Dibaca</div>
                                <div class="text-xs text-gray-500">{{ $notifikasi->dibaca_pada->format('d M Y H:i:s') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Statistik</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">ID Notifikasi:</span>
                        <span class="text-sm font-medium">{{ $notifikasi->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Panjang Judul:</span>
                        <span class="text-sm font-medium">{{ strlen($notifikasi->judul) }} karakter</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Panjang Isi:</span>
                        <span class="text-sm font-medium">{{ strlen($notifikasi->isi) }} karakter</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Waktu Terkirim:</span>
                        <span class="text-sm font-medium">{{ $notifikasi->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex items-center justify-end space-x-3 pt-6 border-t">
        <form action="{{ route('admin.notifikasis.destroy', $notifikasi->id) }}" 
              method="POST" 
              class="inline"
              onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-trash mr-2"></i>Hapus
            </button>
        </form>
    </div>
</div>
@endsection