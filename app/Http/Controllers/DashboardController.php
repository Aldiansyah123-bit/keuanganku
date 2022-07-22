<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use App\Models\Tabungan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pendapatan'    => Pendapatan::sum('qty'),
            'pengeluaran'   => Pengeluaran::sum('qty'),
            'tabungan'      => Tabungan::sum('qty'),
        ];
        return view('admin.dashboard', $data);
    }
}
