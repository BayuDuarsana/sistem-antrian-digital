<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Queue;
use App\Models\Staff;
use DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $activeQueues = Queue::where('status', 'waiting')->count();
        $activeStaff = Staff::where('active', 1)->count();
        $topStaff = Queue::select('staff_id', \DB::raw('COUNT(*) as served_count'))
        ->whereNotNull('done_at') 
        ->groupBy('staff_id')
        ->orderByDesc('served_count')
        ->with('staff:id,name') 
        ->take(3)
        ->get();  

        $currentQueue = Queue::where('status', 'called')->first();
        return Inertia::render('Dashboard', compact( 'currentQueue', 'activeQueues', 'activeStaff', 'topStaff'));
    }
}
