<?php

namespace App\Http\Controllers;

use App\Models\HabitLog;
use App\Models\Habit;
use Illuminate\Http\Request;

use App\Http\Resources\HabitLogResource;

use App\Http\Requests\StoreHabitLogRequest;

class HabitLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Habit $habit)
    {
        
        return HabitLogResource::collection($habit->logs()->paginate());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHabitLogRequest $request, Habit $habit)
    {
        
        $log = $habit->logs()->updateOrCreate([
            'uuid' => $request->string('uuid'),
            'habit_id' => $habit->id,
            'completed_at' => $request->date('completed_at')
        ]);

        return HabitLogResource::make($log);

    }

    /**
     * Display the specified resource.
     */
    public function show(HabitLog $habitLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HabitLog $habitLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HabitLog $habitLog)
    {
        //
    }
}
