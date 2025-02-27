<?php

declare(strict_types = 1);

use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;

use Illuminate\Support\Facades\Route;

Route::get('/', fn (): array => [config('app.name')]);

Route::prefix('api')->name('api.')->group(function () {
    // Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
    // Route::get('/habits/{habit:uuid}', [HabitController::class, 'show'])->name('habits.show');
    // Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
    // Route::put('/habits/{habit:uuid}', [HabitController::class, 'update'])->name('habits.update');
    // Route::delete('/habits/{habit:uuid}', [HabitController::class, 'destroy'])->name('habits.destroy');

    Route::apiResource('habits', HabitController::class)->scoped(['habit' => 'uuid']);

    Route::apiResource('habits.logs', HabitLogController::class)
        ->only(['index', 'show', 'store', 'destroy'])
        ->scoped(['habit' => 'uuid', 'log' => 'uuid']);
});
