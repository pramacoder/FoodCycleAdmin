@extends('layouts.admin')

@section('title', 'Edit Pajak')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pajak</h1>
        <a href="{{ route('admin.pajak.show', $pajak->id) }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.pajak.update', $pajak->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Form Utama -->
            <div class="space-y-4">
                <div>
                    <label for="persentase" class="block text-sm font-medium text-gray-700 mb-1">
                        Persentase Pajak <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                               id="persentase" 
                               name="persentase" 
                               value="{{ old('persentase', $pajak->persentase) }}"
                               min="0" 
                               max="100" 
                               step="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-8"
                               placeholder="Masukkan persentase pajak"
                               required>
                        <span class="absolute right-3 top-2 text-gray-500">%</span>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Contoh: 10.5 untuk 10.5%</p>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" 
                            name="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="aktif" {{ old('status', $pajak->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $pajak->status) == 'nonaktif' ? 'selected' : '' }}>Non-aktif</option>
                    </select>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Masukkan deskripsi pajak (opsional)">{{ old('deskripsi', $pajak->deskripsi ?? '') }}</textarea>
                </div>
            </div>

            <!-- Preview & Informasi -->
            <div class="space-y-4">
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-blue-800 mb-2">Preview Perhitungan</h3>
                    <div class="space-y-2 text-sm text-blue-700">
                        <div class="flex justify-between">
                            <span>Subtotal contoh:</span>
                            <span>Rp 100.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Pajak (<span id="preview-pajak">{{ $pajak->persentase }}</span>%):</span>
                            <span id="preview-nilai">Rp {{ number_format($pajak->persentase * 1000, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-medium border-t border-blue-200 pt-2">
                            <span>Total:</span>
                            <span id="preview-total">Rp {{ number_format(100000 + ($pajak->persentase * 1000), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-yellow-800 mb-2">
                        <i class="fas fa-info-circle mr-1"></i>Informasi Penting
                    </h3>
                    <ul class="text-sm text-yellow-700 space-y-1">
                        <li>• Perubahan pajak akan berlaku untuk transaksi selanjutnya</li>
                        <li>• Transaksi yang sedang berlangsung tidak akan terpengaruh</li>
                        <li>• Pastikan persentase pajak sesuai dengan regulasi yang berlaku</li>
                    </ul>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi Saat Ini</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Pajak sekarang:</span>
                            <span class="font-medium">{{ $pajak->persentase }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Terakhir diubah:</span>
                            <span class="font-medium">{{ $pajak->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
            <a href="{{ route('admin.pajak.show', $pajak->id) }}" 
               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                Batal
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-200">
                <i class="fas fa-save mr-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const persentaseInput = document.getElementById('persentase');
    const previewPajak = document.getElementById('preview-pajak');
    const previewNilai = document.getElementById('preview-nilai');
    const previewTotal = document.getElementById('preview-total');
    
    persentaseInput.addEventListener('input', function() {
        const persentase = parseFloat(this.value) || 0;
        const subtotal = 100000;
        const pajak = subtotal * (persentase / 100);
        const total = subtotal + pajak;
        
        previewPajak.textContent = persentase.toFixed(2);
        previewNilai.textContent = 'Rp ' + pajak.toLocaleString('id-ID');
        previewTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
    });
});
</script>
@endsection