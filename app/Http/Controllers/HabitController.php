<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;

use App\Http\Resources\HabitResource;

use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    public function index()
    {

        request()->validate([
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i']
        ]);

        return HabitResource::collection(

            Habit::query()
                ->where('user_id', Auth::id())
                ->when(
                    request()->string('with', '')->contains('user'), 
                    fn ($query) => $query->with('user') 
                )
                ->when(
                   request()->string('with', '')->contains('logs'),
                    fn ($query) => $query->with('logs')
                )
            ->paginate()

        );

    }

    public function show(Habit $habit)
    {

        request()->validate([
            'with' => ['string', 'nullable', 'regex:/\b(?:logs|user)(?:.*\b(?:logs|user))?/i']
        ]);

        $load = request()->string('with')->explode(',')->filter(fn ($w) => strlen($w) > 0)->toArray();

        return HabitResource::make(

            $habit->load($load)

        );
    }

    public function store(StoreHabitRequest $request)
    {

        $habit = Auth::user()->habits()->create($request->validated());

        return HabitResource::make($habit);
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {

        $habit->update($request->validated());

        return HabitResource::make($habit);
    }

    public function destroy(Habit $habit)
    {
        $habit->logs()->delete();

        $habit->delete();

        return response()->noContent();
    }
}
