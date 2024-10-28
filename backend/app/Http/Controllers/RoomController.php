<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        $user = $request->user();
        return $user->rooms;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Room
    {
        Gate::authorize('create', Room::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number_of_sprints' => 'required|integer|max:99|min:1',
            'sprint_duration' => 'required|integer|max:297|min:1',
            'build_phase_duration' => 'required|integer|max:99|min:1',
            'planning_duration' => 'required|integer|max:99|min:1',
            'review_duration' => 'required|integer|max:99|min:1',
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
            'number_of_sprints' => 'required|integer|max:99|min:1',
            'sprint_duration' => 'required|integer|max:99|min:1',
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
}
