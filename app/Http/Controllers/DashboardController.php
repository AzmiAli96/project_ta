<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
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
        return view ('dashbord', ['sidangs'=>$sidang]);

    }

    // public function char($id){
    //     $userCount = User::count();
    //     return view('dashboard', compact('userCount'));
    // }

    
}