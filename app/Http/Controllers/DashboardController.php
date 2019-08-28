<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\PenjualanDetail;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $today = Carbon::now();
        $penjualanHariIni = PenjualanDetail::whereRaw('DATE_FORMAT(penjualan_details.created_at, "%Y-%m-%d") = "' . $today->toDateString() . '"')
            ->leftJoin('mobils AS b', 'b.id', '=', 'penjualan_details.mobil_id')
            ->groupBy('mobil_id')
            ->orderBy('total_jumlah', 'DESC')
            ->orderBy('total_subtotal', 'DESC')
            ->select([
                'mobil_id',
                'b.nama AS nama_mobil',
                DB::raw('SUM(jumlah) AS total_jumlah'),
                DB::raw('SUM(subtotal) AS total_subtotal')
            ])
            ->first();

        if ($penjualanHariIni) {
            $yesterday = clone $today;
            $yesterday = $yesterday->subDay();
            $penjualanKemarin = PenjualanDetail::whereRaw('DATE_FORMAT(penjualan_details.created_at, "%Y-%m-%d") = "' . $yesterday->toDateString() . '"')
                ->leftJoin('mobils AS b', 'b.id', '=', 'penjualan_details.mobil_id')
                ->where('mobil_id', $penjualanHariIni->mobil_id)
                ->groupBy('mobil_id')
                ->select([
                    'mobil_id',
                    'b.nama AS nama_mobil',
                    DB::raw('SUM(jumlah) AS total_jumlah'),
                    DB::raw('SUM(subtotal) AS total_subtotal')
                ])
                ->first();
        }

        $weekBefore = clone $today;
        $weekBefore = $weekBefore->subWeek();
        $penjualanSeminggu = PenjualanDetail::whereRaw('DATE_FORMAT(penjualan_details.created_at, "%Y-%m-%d") >= "' . $weekBefore->toDateString() . '"')
            ->leftJoin('mobils AS b', 'b.id', '=', 'penjualan_details.mobil_id')
            ->groupBy('mobil_id')
            ->orderBy('total_jumlah', 'DESC')
            ->orderBy('total_subtotal', 'DESC')
            ->select([
                'mobil_id',
                'b.nama AS nama_mobil',
                DB::raw('SUM(jumlah) AS total_jumlah'),
                DB::raw('SUM(subtotal) AS total_subtotal')
            ])
            ->first();

        return view('dashboard', get_defined_vars());
    }
}
