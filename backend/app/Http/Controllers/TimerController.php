<?php

namespace App\Http\Controllers;

use App\Services\TimerService;
use Illuminate\Http\Request;
use App\Models\Room;

class TimerController extends Controller
{
    /**
     * Start a timer for a room
     */
    public function pause(Request $request, Room $room)
    {
        try {
            $timer = new TimerService($room->id);
            $timer->pause();
            return response()->json(['message' => 'Timer paused', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error pausing timer', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Stop a timer for a room
     */
    public function resume(Request $request, Room $room)
    {
        try {
            $timer = new TimerService($room->id);
            $timer->resume();
            return response()->json(['message' => 'Timer resumed', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error resuming timer', 'error' => $e->getMessage()], 500);
        }
    }
}


