<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    
    public function index()
{
    $totalProduk = DB::table('produk')->count();
    $totalPesanan = DB::table('pesanan')->count();
    $totalRevenue = DB::table('pesanan')->sum('total_harga');
    $totalCustomer = DB::table('users')->count();

    // 👉 TAMBAHKAN DI SINI
    $produkTerlaris = DB::table('pesanan_item')
        ->join('produk_ukuran', 'produk_ukuran.id_produk_ukuran', '=', 'pesanan_item.id_produk_ukuran')
        ->join('produk', 'produk.id_produk', '=', 'produk_ukuran.id_produk')
        ->select(
            'produk.nama',
            DB::raw('SUM(pesanan_item.kuantitas) as total_terjual')
        )
        ->groupBy('produk.nama')
        ->orderByDesc('total_terjual')
        ->limit(5)
        ->get();

    return view('admin.dashboard.index', compact(
        'totalProduk',
        'totalPesanan',
        'totalRevenue',
        'totalCustomer',
        'produkTerlaris'
    ));
}


    public function chartData()
    {
        $data = DB::table('pesanan')
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $item) {
            $labels[] = date('M', mktime(0, 0, 0, $item->bulan, 1));
            $values[] = $item->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $values
        ]);
    }

    public function produkTerlaris()
    {
        $produkTerlaris = DB::table('pesanan_item')
            ->join('produk_ukuran', 'produk_ukuran.id_produk_ukuran', '=', 'pesanan_item.id_produk_ukuran')
            ->join('produk', 'produk.id_produk', '=', 'produk_ukuran.id_produk')
            ->select(
                'produk.nama',
                DB::raw('SUM(pesanan_item.kuantitas) as total_terjual')
            )
            ->groupBy('produk.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return response()->json($produkTerlaris);
    }

    public function dashboard()
    {
        $totalProduk = DB::table('produk')->count();
        $totalPesanan = DB::table('pesanan')->count();
        $totalRevenue = DB::table('pesanan')->sum('total_harga');
        $totalCustomer = DB::table('users')->count();

        $produkTerlaris = DB::table('pesanan_item')
            ->join('produk_ukuran', 'produk_ukuran.id_produk_ukuran', '=', 'pesanan_item.id_produk_ukuran')
            ->join('produk', 'produk.id_produk', '=', 'produk_ukuran.id_produk')
            ->select(
                'produk.nama',
                DB::raw('SUM(pesanan_item.kuantitas) as total_terjual')
            )
            ->groupBy('produk.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalProduk',
            'totalPesanan',
            'totalRevenue',
            'totalCustomer',
            'produkTerlaris'
        ));
    }
}
