<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - FoodCycle Admin</title>
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

        <!-- Forgot Password Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-6">
                <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-key text-blue-600 text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Lupa Password?</h2>
                <p class="text-gray-600 mt-2">Masukkan email Anda dan kami akan mengirimkan link reset password</p>
            </div>
            
            @if (session('status'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-check-circle text-green-400 mr-3 mt-0.5"></i>
                        <div class="text-green-700">{{ session('status') }}</div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-0.5"></i>
                        <div class="text-red-700">{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="mb-6">
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

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Link Reset Password
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Ingat password Anda? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                        Kembali ke login
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-500">
            <p>&copy; 2024 FoodCycle. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>