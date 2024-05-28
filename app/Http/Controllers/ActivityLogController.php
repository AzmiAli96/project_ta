<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activitylog;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activitylog::query();

        if ($request->has('search')) {
            $activities->where('description', 'like', '%' . $request->search . '%');
        }

        $activities = $activities->paginate(10);
        return view('activitylog.index', compact('activities'));
    }

    
}
