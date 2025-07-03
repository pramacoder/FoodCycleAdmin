@extends('layouts.admin')

@section('title', 'Kirim Notifikasi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kirim Notifikasi Baru</h1>
        <a href="{{ route('admin.notifikasis.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda:
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.notifikasis.store') }}" method="POST" id="notificationForm">
        @csrf
        
        <!-- Target Selection -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Target Penerima <span class="text-red-500">*</span>
            </label>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="radio" 
                           id="target_all" 
                           name="target" 
                           value="all" 
                           class="mr-2"
                           {{ old('target') === 'all' ? 'checked' : '' }}
                           onchange="toggleUserSelection()">
                    <label for="target_all" class="text-sm text-gray-700">Semua User</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" 
                           id="target_user" 
                           name="target" 
                           value="user" 
                           class="mr-2"
                           {{ old('target') === 'user' ? 'checked' : '' }}
                           onchange="toggleUserSelection()">
                    <label for="target_user" class="text-sm text-gray-700">User Tertentu</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" 
                           id="target_admin" 
                           name="target" 
                           value="admin" 
                           class="mr-2"
                           {{ old('target') === 'admin' ? 'checked' : '' }}
                           onchange="toggleUserSelection()">
                    <label for="target_admin" class="text-sm text-gray-700">Admin</label>
                </div>
            </div>
        </div>

        <!-- User Selection (only show when target is 'user') -->
        <div id="userSelection" class="mb-6 hidden">
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                Pilih User <span class="text-red-500">*</span>
            </label>
            <select name="user_id" id="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Pilih User...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->nama }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Title -->
        <div class="mb-6">
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                Judul Notifikasi <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="judul" 
                   name="judul" 
                   value="{{ old('judul') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('judul') border-red-500 @enderror"
                   placeholder="Masukkan judul notifikasi"
                   required>
            @error('judul')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                Isi Notifikasi <span class="text-red-500">*</span>
            </label>
            <textarea id="isi" 
                      name="isi" 
                      rows="6"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('isi') border-red-500 @enderror"
                      placeholder="Masukkan isi notifikasi..."
                      required>{{ old('isi') }}</textarea>
            @error('isi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-sm text-gray-500">
                <span id="charCount">0</span>/500 karakter
            </p>
        </div>

        <!-- Preview Section -->
        <div class="mb-6 bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Preview Notifikasi</h3>
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-bell text-blue-500 text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium text-gray-900" id="previewTitle">
                            [Judul akan muncul di sini]
                        </div>
                        <div class="text-sm text-gray-600 mt-1" id="previewContent">
                            [Isi notifikasi akan muncul di sini]
                        </div>
                        <div class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-clock mr-1"></i>
                            {{ now()->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Send Options -->
        <div class="mb-6 bg-blue-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-blue-800 mb-2">
                <i class="fas fa-info-circle mr-2"></i>Informasi Pengiriman
            </h3>
            <div class="text-sm text-blue-700">
                <p>• Notifikasi akan dikirim langsung ke Firebase</p>
                <p>• User akan menerima notifikasi push di aplikasi mobile</p>
                <p>• Notifikasi juga tersimpan di database untuk riwayat</p>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('admin.notifikasis.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200">
                <i class="fas fa-paper-plane mr-2"></i>Kirim Notifikasi
            </button>
        </div>
    </form>
</div>

<script>
function toggleUserSelection() {
    const targetUser = document.getElementById('target_user');
    const userSelection = document.getElementById('userSelection');
    const userSelect = document.getElementById('user_id');
    
    if (targetUser.checked) {
        userSelection.classList.remove('hidden');
        userSelect.required = true;
    } else {
        userSelection.classList.add('hidden');
        userSelect.required = false;
        userSelect.value = '';
    }
}

// Character counter and preview
document.getElementById('judul').addEventListener('input', function() {
    document.getElementById('previewTitle').textContent = this.value || '[Judul akan muncul di sini]';
});

document.getElementById('isi').addEventListener('input', function() {
    const charCount = this.value.length;
    document.getElementById('charCount').textContent = charCount;
    document.getElementById('previewContent').textContent = this.value || '[Isi notifikasi akan muncul di sini]';
    
    // Change color based on character count
    const charCountElement = document.getElementById('charCount');
    if (charCount > 450) {
        charCountElement.className = 'text-red-500 font-medium';
    } else if (charCount > 350) {
        charCountElement.className = 'text-yellow-500 font-medium';
    } else {
        charCountElement.className = 'text-gray-500';
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleUserSelection();
});