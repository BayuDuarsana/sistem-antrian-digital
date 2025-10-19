<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Queue;
use App\Models\Staff;
use Inertia\Inertia;

class QueueController extends Controller
{

    public function index()
    {
        $queues = Queue::latest()->get();

        return Inertia::render('Queues/Index', compact('queues'));
    }

    public function create()
    {
        $services = Service::all();
        $staff = Staff::where('active', 1)->get();

        return Inertia::render('Queues/Create', [
            'services' => $services,
            'staff' => $staff,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:reservation,walkin',
            'staff_id' => 'nullable|exists:staff,id',
        ]);

        $prefix = $request->type === 'reservation' ? 'R' : 'W';
        $latestCount = Queue::where('type', $request->type)->count() + 1;

        $queueNumber = sprintf('%s%03d', $prefix, $latestCount);

        Queue::create([
            'queue_number' => $queueNumber,
            'type' => $request->type,
            'staff_id' => $request->staff_id,
            'status' => 'waiting', 
            'active' => 1,
        ]);

        return redirect()->route('queues.index')->with('message', 'Queue created successfully.');
    }
}
