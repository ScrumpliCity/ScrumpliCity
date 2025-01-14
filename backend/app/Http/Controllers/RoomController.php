<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Services\TimerService;
use Illuminate\Support\Facades\Cache;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        $user = $request->user();
        return $user->rooms->load('teams')->append('team_count')->makeHidden('teams');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Room
    {
        Gate::authorize('create', Room::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number_of_sprints' => 'required|integer|max:12|min:1',
            'sprint_duration' => 'required|integer|max:120|min:1',
            'build_phase_duration' => 'required|integer|max:60|min:1',
            'planning_duration' => 'required|integer|max:30|min:1',
            'review_duration' => 'required|integer|max:30|min:1',
        ]);

        // Not using ::create() because the user_id is not nullable and needs to be associated before saving
        $room = new Room($validated);
        $room->user()->associate($request->user());
        $room->save();
        return $room;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Room $room): Room
    {
        Gate::authorize('view', $room);
        return $room;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room): Room
    {
        Gate::authorize('update', $room);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number_of_sprints' => 'required|integer|max:12|min:1',
            'sprint_duration' => 'required|integer|max:120|min:1',
            'build_phase_duration' => 'required|integer|max:60|min:1',
            'planning_duration' => 'required|integer|max:30|min:1',
            'review_duration' => 'required|integer|max:30|min:1',
        ]);

        $room->update($validated);
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Room $room): JsonResponse
    {
        Gate::authorize('delete', $room);

        $room->delete();
        return response()->json(null, 204);
    }


    /**
     * Generate a random temporary room code for this room. 
     */
    public function generateRoomCode(Room $room): JsonResponse
    {

        Gate::authorize('update', $room);

        if ($room->roomcode) {
            return response()->json(['roomcode' => $room->roomcode]);
        }

        do {
            $code = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
            $code .= array_sum(str_split($code)) % 10;
        } while (Room::where('roomcode', $code)->exists());
        $room->roomcode = $code;
        $room->save();
        return response()->json(['roomcode' => $code]);
    }

    /**
     * Show the room with all its teams and members.
     */
    public function showSingleRoom(Request $request, Room $room): JsonResponse
    {
        Gate::authorize('view', $room);
        $room->load(['teams.members']);
        return response()->json($room);
    }
    

    public function togglePlaying(Request $request, Room $room): JsonResponse
    {
        try {
            Gate::authorize('update', $room);

            $room->is_playing = !$room->is_playing;

            if ($room->is_playing) {
                $this->startRoom($room);
            } else {
                $this->stopRoom($room);
            }

            $room->save();

            return response()->json([
                'status' => 'success',
                'room' => $room->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function startRoom(Room $room): void
    {
        if ($room->current_phase === null) {
            $room->current_phase = 'planning';
            $room->current_sprint = 1;
            $room->save();
        }

        $timer = new TimerService($room->id);
        error_log("Starting timer for phase: " . $room->current_phase);
        $timer->start($room->getPhaseDuration());
    }

    private function stopRoom(Room $room): void
    {
        $timer = new TimerService($room->id);
        $timer->stop();
    }
}
