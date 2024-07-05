<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TA;
use App\Models\Sidang;

class ChartDataController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $tugasAkhirCount = TA::count();
        $penjadwalanCount = Sidang::count();
        $finishCount = 0; // Sesuaikan dengan logika yang diperlukan untuk menghitung 'Finish'

        // Data untuk bar chart
        $barChartData = [
            'labels' => ["User", "Tugas Akhir", "Penjadwalan", "Finish"],
            'counts' => [$userCount, $tugasAkhirCount, $penjadwalanCount, $finishCount]
        ];

        // Data untuk pie chart
        $pieChartData = [
            'labels' => ["Tugas Akhir", "Penjadwalan", "Finish"],
            'counts' => [$tugasAkhirCount, $penjadwalanCount, $finishCount]
        ];

        return view('dashboard', compact('barChartData', 'pieChartData'));
    }
}
