<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Notifikasi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get real data if available, otherwise use demo data
        $totalUsers = User::count() ?: 1247;
        $totalTransaksi = Transaksi::count() ?: 892;
        $totalKategori = Kategori::count() ?: 15;
        $totalNotifikasi = Notifikasi::count() ?: 234;

        // Get recent transactions or create demo data
        $recentTransaksi = Transaksi::with('user')
            ->latest('tanggal_transaksi')
            ->take(5)
            ->get();

        // If no real data, create demo transactions
        if ($recentTransaksi->isEmpty()) {
            $recentTransaksi = collect([
                (object) [
                    'id' => 1001,
                    'user' => (object) ['nama' => 'Ahmad Rahman'],
                    'total_harga' => 150000,
                    'status' => 'completed',
                    'tanggal_transaksi' => Carbon::now()->subMinutes(5)
                ],
                (object) [
                    'id' => 1002,
                    'user' => (object) ['nama' => 'Siti Nurhaliza'],
                    'total_harga' => 275000,
                    'status' => 'pending',
                    'tanggal_transaksi' => Carbon::now()->subMinutes(15)
                ],
                (object) [
                    'id' => 1003,
                    'user' => (object) ['nama' => 'Budi Santoso'],
                    'total_harga' => 89000,
                    'status' => 'completed',
                    'tanggal_transaksi' => Carbon::now()->subMinutes(30)
                ],
                (object) [
                    'id' => 1004,
                    'user' => (object) ['nama' => 'Dewi Sartika'],
                    'total_harga' => 320000,
                    'status' => 'cancelled',
                    'tanggal_transaksi' => Carbon::now()->subMinutes(45)
                ],
                (object) [
                    'id' => 1005,
                    'user' => (object) ['nama' => 'Rudi Hermawan'],
                    'total_harga' => 185000,
                    'status' => 'completed',
                    'tanggal_transaksi' => Carbon::now()->subMinutes(60)
                ]
            ]);
        }

        // Calculate growth percentages (demo data)
        $userGrowth = 12;
        $transaksiGrowth = 8;
        $kategoriGrowth = 0;
        $notifikasiGrowth = 25;

        // Get monthly revenue data for chart
        $monthlyRevenue = $this->getMonthlyRevenue();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTransaksi', 
            'totalKategori',
            'totalNotifikasi',
            'recentTransaksi',
            'userGrowth',
            'transaksiGrowth',
            'kategoriGrowth',
            'notifikasiGrowth',
            'monthlyRevenue'
        ));
    }

    private function getMonthlyRevenue()
    {
        // Demo monthly revenue data
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => [
                12500000, 15800000, 14200000, 18900000, 20100000, 23400000,
                19800000, 24500000, 26700000, 28900000, 31200000, 29800000
            ]
        ];
    }

    public function getStats()
    {
        // API endpoint for real-time stats updates
        $stats = [
            'users' => User::count() ?: rand(1200, 1300),
            'transactions' => Transaksi::count() ?: rand(850, 950),
            'categories' => Kategori::count() ?: rand(12, 18),
            'notifications' => Notifikasi::count() ?: rand(200, 250)
        ];

        return response()->json($stats);
    }

    public function getRecentActivity()
    {
        // Demo recent activity data
        $activities = [
            [
                'type' => 'user_registered',
                'message' => 'User baru mendaftar',
                'time' => '2 menit yang lalu',
                'icon' => 'fa-user-plus',
                'color' => 'blue'
            ],
            [
                'type' => 'transaction_completed',
                'message' => 'Transaksi berhasil',
                'time' => '5 menit yang lalu',
                'icon' => 'fa-check',
                'color' => 'green'
            ],
            [
                'type' => 'low_stock',
                'message' => 'Stok menipis',
                'time' => '10 menit yang lalu',
                'icon' => 'fa-exclamation',
                'color' => 'yellow'
            ],
            [
                'type' => 'notification_sent',
                'message' => 'Notifikasi terkirim',
                'time' => '15 menit yang lalu',
                'icon' => 'fa-bell',
                'color' => 'purple'
            ]
        ];

        return response()->json($activities);
    }
}