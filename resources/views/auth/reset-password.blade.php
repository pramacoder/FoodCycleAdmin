Saya ingin membuat website sebagai role admin, intinya saya memiliki aplikasi FoodCycle yang dimana menggunakan sistem peer to peer, jadi seperti interaksi konsumen dengan konsumen, yang dimana konsumen dapat berinteraksi di mobile yang sudah saya buat dengan flutter yang databasenya menggunakan Fir

pasted

Edit
Saya akan membantu Anda membuat views untuk admin pajak dan route web.php yang lengkap. Berdasarkan kebutuhan Anda, saya akan membuat:

View untuk pajak (show dan edit)
Route web.php yang lengkap
Views yang masih kurang untuk login system
Mari saya mulai dengan membuat views pajak:


admin/pajak/show.blade.php
Kode 

admin/pajak/edit.blade.php
Kode 
Sekarang saya akan membuat route web.php yang lengkap:


web.php
Kode 
Sekarang saya akan membuat views yang masih kurang untuk sistem login:


auth/login.blade.php
Kode 



Lanjutkan

Edit

auth/login.blade.php
Kode ∙ Versi 2 
Sekarang saya akan membuat view untuk register:


auth/register.blade.php
Kode 
Sekarang saya akan membuat view untuk forgot password:


auth/forgot-password.blade.php
Kode 
Sekarang saya akan membuat view untuk reset password:


auth/reset-password.blade.php
Kode 
Akhirnya, saya akan membuat view untuk transaksi yang mungkin belum lengkap:


admin/transaksi/index.blade.php
Kode 






<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - FoodCycle Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="mx-auto h-16 w-16 bg-green-500 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-recycle text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">FoodCycle</h1>
            <p class="text-gray-600 mt-2">Reset Password</p>
        </div>

        <!-- Reset Password Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-6">
                <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-blue-600 text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Reset Password</h2>
                <p class="text-gray-600 mt-2">Masukkan password baru Anda</p>
            </div>
            
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-0.5"></i>
                        <div class="text-red-700">{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $email ?? '') }}"
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
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Masukkan password baru"
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
                               placeholder="Ulangi password baru"
                               required>
                        <i class="fas fa-lock absolute left-3 top-3.5 text-gray-400"></i>
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600">
                            <i id="passwordConfirmToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Reset Password
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Kembali ke 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        halaman login
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