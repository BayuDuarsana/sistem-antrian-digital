<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Service;
use App\Models\Queue;
use Inertia\Inertia;

class CallController extends Controller
{
    public function next(Request $request)
    {
        $lastServices = Service::whereDate('called_at', today())
            ->with('queue')
            ->orderBy('called_at', 'desc')
            ->limit(2)
            ->get();

        $consecutiveReservations = 0;
        foreach ($lastServices as $service) {
            if ($service->queue->type === 'reservation') {
                $consecutiveReservations++;
            } else {
                break; 
            }
        }

        $typeToCall = ($consecutiveReservations >= 2) ? 'walkin' : 'reservation';

        $queue = Queue::where('type', $typeToCall)
            ->where('status', 'waiting')
            ->orderBy('id')
            ->first();

        if (!$queue) {
            $altType = $typeToCall === 'reservation' ? 'walkin' : 'reservation';

            $queue = Queue::where('type', $altType)
                ->where('status', 'waiting')
                ->orderBy('id')
                ->first();
        }

        if (!$queue) {
            return response()->json(['message' => 'No queue available'], 404);
        }

        $queue->update([
            'status' => 'called',
            'called_at' => now(),
        ]);

        Service::create([
            'queue_id' => $queue->id,
            'staff_id' => $queue->staff_id,
            'called_at' => now(),
        ]);

        return response()->json([
            'message' => 'Next queue called successfully'
        ]);
    }


    public function done(Request $request, $id)
    {
        $queue = Queue::findOrFail($id);
        $queue->update([
            'status' => 'done',
            'done_at' => now(),
        ]);

        return response()->json([
            'message' => 'Queue marked as done successfully'
        ]);
    }
}
