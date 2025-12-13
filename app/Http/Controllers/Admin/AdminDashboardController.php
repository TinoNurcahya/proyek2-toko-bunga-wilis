<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
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
}
