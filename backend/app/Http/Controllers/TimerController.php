<?php

namespace App\Http\Controllers;

use App\Services\TimerService;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Gate;


class TimerController extends Controller 
{
    /**
     * Pause a timer for a room
     */
    public function pause(Request $request, Room $room)
    {
        Gate::authorize('update', $room);

        try {
            $timer = new TimerService($room->id);
            $timer->pause();
            return response()->json(['message' => 'Timer paused', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error pausing timer', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Resume a timer for a room
     */
    public function resume(Request $request, Room $room)
    {
        Gate::authorize('update', $room);

        try {
            $timer = new TimerService($room->id);
            $timer->resume();
            return response()->json(['message' => 'Timer resumed', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error resuming timer', 'error' => $e->getMessage()], 500);
        }
    }

    public function skipForward(Room $room)
    {
        Gate::authorize('update', $room);

        try {
            $timer = new TimerService($room->id);
            $timer->skip(30);
            return response()->json(['message' => 'Timer forwarded', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error resuming timer', 'error' => $e->getMessage()], 500);
        }
    }

    public function skipBackward(Room $room)
    {
        Gate::authorize('update', $room);

        try {
            $timer = new TimerService($room->id);
            $timer->skip(-30);
            return response()->json(['message' => 'Timer turned back', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error resuming timer', 'error' => $e->getMessage()], 500);
        }
    }

    public function skipToEnd(Room $room)
    {
        Gate::authorize('update', $room);

        try {
            $timer = new TimerService($room->id);
            $timer->skipToEnd();
            return response()->json(['message' => 'Timer skipped', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error resuming timer', 'error' => $e->getMessage()], 500);
        }
    }

}
