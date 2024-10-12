<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Room::all(); // tbd on finishing login: showing only the users rooms
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'number_of_sprints' => 'required|integer|max:99|min:1',
            'sprint_duration' => 'required|integer|max:99|min:1',
        ]);

        $room = Room::create($validated);
        return $room;
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): Room
    {
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
    public function destroy(Room $room): JsonResponse
    {
        $room->delete();
        return response()->json(null, 204);
    }
}
