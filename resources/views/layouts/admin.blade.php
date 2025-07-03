<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-green-800 text-white fixed h-full z-30 transition-transform duration-300 lg:translate-x-0 -translate-x-full">
            <div class="p-4 border-b border-green-700">
                <h1 class="text-2xl font-bold flex items-center gap-2">
                    <i class="fas fa-recycle"></i>
                    FoodCycle Admin
                </h1>
            </div>
            
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-tachometer-alt w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('admin.users.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-users w-5"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kategoris.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('admin.kategoris.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-tags w-5"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.transaksis.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('admin.transaksis.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-exchange-alt w-5"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.notifikasis.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('admin.notifikasis.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-bell w-5"></i>
                            <span>Notifikasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pajak.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('admin.pajak.*') ? 'bg-green-700' : '' }}">
                            <i class="fas fa-percentage w-5"></i>
                            <span>Pengaturan Pajak</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="absolute bottom-0 w-full p-4 border-t border-green-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700 transition w-full">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 lg:ml-64">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <button id="sidebarToggle" class="lg:hidden">
                        <i class="fas fa-bars text-2xl text-gray-600"></i>
                    </button>
                    
                    <div class="flex items-center gap-4 ml-auto">
                        <span class="text-gray-600">{{ auth()->user()->nama }}</span>
                        <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white">
                            {{ substr(auth()->user()->nama, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"></div>
    
    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const overlay = document.getElementById('overlay');
        
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
    
    @stack('scripts')
</body>
</html>
