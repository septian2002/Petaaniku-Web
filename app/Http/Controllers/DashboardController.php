<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\Anggota;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Menghitung jumlah data dari masing-masing model
        $totalOrders = Order::count();
        $totalAnggota = Anggota::count();
        $totalProducts = Product::count();

        // Menghitung jumlah pesanan untuk setiap status
        $totalPesananBaru = Order::where('status', 'Baru')->count();
        $totalPesananDikonfirmasi = Order::where('status', 'Dikonfirmasi')->count();
        $totalPesananDikemas = Order::where('status', 'Dikemas')->count();
        $totalPesananDikirim = Order::where('status', 'Dikirim')->count();
        $totalPesananDiterima = Order::where('status', 'Diterima')->count();
        $totalPesananSelesai = Order::where('status', 'Selesai')->count();

        // Mengirim semua data ke dashboard.blade.php
        return view('dashboard', [
            'totalOrders' => $totalOrders,
            'totalAnggota' => $totalAnggota,
            'totalProducts' => $totalProducts,
            'totalPesananBaru' => $totalPesananBaru,
            'totalPesananDikonfirmasi' => $totalPesananDikonfirmasi,
            'totalPesananDikemas' => $totalPesananDikemas,
            'totalPesananDikirim' => $totalPesananDikirim,
            'totalPesananDiterima' => $totalPesananDiterima,
            'totalPesananSelesai' => $totalPesananSelesai,
        ]);
    }
}

