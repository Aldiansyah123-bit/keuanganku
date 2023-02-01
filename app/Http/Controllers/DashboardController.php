<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use App\Models\Tabungan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $day = date('d');
        $week = Carbon::now()->subDays(7);
        $month = date('m');
        $year = date('YYYY');
        $pendapatan = Pendapatan::whereMonth('created_at', $month)->sum('qty');
        $pengeluaran = Pengeluaran::whereMonth('created_at', $month)->sum('qty');
        $pendapatan_bersih = $pendapatan - $pengeluaran;
        $data = [
            'pendapatan'    => Pendapatan::sum('qty'),
            'pend_perbulan' => Pendapatan::whereMonth('created_at', $month)->sum('qty'),
            'pend_pertahun' => Pendapatan::whereYear('created_at', '<=',$year)->sum('qty'),
            'pengeluaran'   => Pengeluaran::sum('qty'),
            'keluar_day'    => Pengeluaran::whereDay('created_at', $day)->sum('qty'),
            'keluar_week'   => Pengeluaran::where('created_at', '>=', $week)->sum('qty'),
            'keluar_month'  => Pengeluaran::whereMonth('created_at', $month)->sum('qty'),
            'pend_bersih'   => $pendapatan_bersih,
            'tabungan'      => Tabungan::sum('qty'),
        ];
        return view('admin.dashboard', $data);
    }
}
