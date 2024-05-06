<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->middleware('api')->only(['get_reports']);
    }
    public function get_reports(Request $request)
    {
       $report = DB::table('orders_details')
       ->join('products', 'products.id' , '=', 'orders_details.id_produk')
       ->select(DB::raw('
            nama_barang,
            count(*) as jumlah_dibeli, 
            harga,
            SUM(total) as pendapatan,
            SUM(jumlah) as total_qty'))
        ->whereRaw("date(orders_details.created_at) >= '$request->dari'")
        ->whereRaw("date(orders_details.created_at) <= '$request->sampai'")
        ->groupBy('id_produk', 'nama_barang', 'harga')
        ->get();

       return response()->json([
        'data' => $report
       ]);
    }

    public function index()
    {
        return view('report.index');
    }

}
