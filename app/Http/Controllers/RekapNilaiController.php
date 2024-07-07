<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\TA;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class RekapNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $sidang=Sidang::latest()->paginate(10);
        return view('rekapnilai.index',['sidangs'=>$sidang]);
    }

    
}
