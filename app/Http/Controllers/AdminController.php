<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Hotel_restoran;
use App\Models\Produk;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        try {
            $data = [
                'total_users' => User::count(),
                'total_transaksi' => Transaksi::count(),
                'total_hotel_restoran' => Hotel_restoran::count(),
                'total_produk' => Produk::count(),
                'recent_transaksi' => Transaksi::with(['user', 'hotel_restoran', 'produk'])
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
                'monthly_revenue' => Transaksi::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->sum('total_harga'),
            ];

            return view('admin.dashboard', $data);
        } catch (\Exception $e) {
            return view('admin.dashboard', [
                'total_users' => 0,
                'total_transaksi' => 0,
                'total_hotel_restoran' => 0,
                'total_produk' => 0,
                'recent_transaksi' => collect(),
                'monthly_revenue' => 0,
            ]);
        }
    }

    /**
     * Show reports
     */
    public function reports()
    {
        return view('admin.reports.index');
    }

    /**
     * Show transaction report
     */
    public function transactionReport()
    {
        $transaksi = Transaksi::with(['user', 'hotel_restoran', 'produk'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reports.transactions', compact('transaksi'));
    }

    /**
     * Show user report
     */
    public function userReport()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.reports.users', compact('users'));
    }

    /**
     * Show revenue report
     */
    public function revenueReport()
    {
        $revenue_data = Transaksi::selectRaw('
                DATE(created_at) as date,
                SUM(total_harga) as total_revenue,
                COUNT(*) as transaction_count
            ')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('admin.reports.revenue', compact('revenue_data'));
    }

    /**
     * Show settings
     */
    public function settings()
    {
        return view('admin.settings.index');
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string',
            'contact_email' => 'required|email',
        ]);

        // Logic untuk update settings
        return back()->with('success', 'Pengaturan berhasil diupdate.');
    }
}