<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FoodCycle Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center py-8">
    <div class="max-w-md w-full mx-4">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="mx-auto h-16 w-16 bg-green-500 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-recycle text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">FoodCycle</h1>
            <p class="text-gray-600 mt-2">Daftar Admin Panel</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Buat Akun Baru</h2>
            
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-0.5"></i>
                        <div class="text-red-700">{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama') }}"
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                               placeholder="Masukkan nama lengkap"
                               required>
                        <i class="fas fa-user absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="Masukkan email Anda"
                               required>
                        <i class="fas fa-envelope absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                    <div class="relative">
                        <input type="tel" 
                               id="no_telp" 
                               name="no_telp" 
                               value="{{ old('no_telp') }}"
                               class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_telp') border-red-500 @enderror"
                               placeholder="Masukkan nomor telepon">
                        <i class="fas fa-phone absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    @error('no_telp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <div class="relative">
                        <textarea id="alamat" 
                                  name="alamat" 
                                  rows="3"
                                  class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 @enderror"
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        <i class="fas fa-map-marker-alt absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tipe_pengguna" class="block text-sm font-medium text-gray-700 mb-2">Tipe Pengguna</label>
                    <div class="relative">
                        <select id="tipe_pengguna" 
                                name="tipe_pengguna" 
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tipe_pengguna') border-red-500 @enderror"
                                required>
                            <option value="">Pilih tipe pengguna</option>
                            <option value="admin" {{ old('tipe_pengguna') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('tipe_pengguna') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        <i class="fas fa-user-tag absolute left-3 top-3.5 text-gray-400"></i>
                    </div>
                    @error('tipe_pengguna')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Masukkan password"
                               required>
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i id="passwordToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Ulangi password"
                               required>
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i id="passwordConfirmToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="terms" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                               required>
                        <span class="ml-2 text-sm text-gray-700">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-500">Syarat & Ketentuan</a>
                        </span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        Masuk sekarang
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-500">
            <p>&copy; 2024 FoodCycle. Semua hak dilindungi.</p>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(inputId === 'password' ? 'passwordToggle' : 'passwordConfirmToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>