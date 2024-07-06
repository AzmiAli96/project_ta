<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use Illuminate\Http\Request;

class AwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidang=Sidang::latest()->paginate(10);
        return view ('awal', ['sidangs'=>$sidang]);

    }

    // public function char($id){
    //     $userCount = User::count();
    //     return view('dashboard', compact('userCount'));
    // }

    
}