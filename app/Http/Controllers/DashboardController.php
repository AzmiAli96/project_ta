<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\TA;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidang=Sidang::latest()->paginate(10);
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
        return view('dashboard')->with(['sidangs'=>$sidang, 'barChartData'=>$barChartData, 'pieChartData'=>$pieChartData]);
    }

    // public function char($id){
    //     $userCount = User::count();
    //     return view('dashboard', compact('userCount'));
    // }

    
}