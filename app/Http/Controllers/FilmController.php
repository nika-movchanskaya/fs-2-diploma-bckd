<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Film;

class FilmController extends Controller {
    public function getFilmsByDay(Request $request) {
        $day = $request->query('day');

        if (!$day) {
            return response()->json(['error' => 'Day parameter is required'], 400);
        }

        // Get distinct film IDs for the given day
        $filmIds = DB::table('film_sessions')
            ->where('status', 'active')
            ->whereDate('date', $day)
            ->distinct()
            ->pluck('film_id');

        if ($filmIds->isEmpty()) {
            return response()->json([]);
        }

        // Get all films with halls and times for the given day
        $films = DB::table('films')
            ->whereIn('id', $filmIds)
            ->get()
            ->map(function ($film) use ($day) {
                $hallTimes = DB::table('film_sessions')
                    ->join('halls', 'film_sessions.hall_id', '=', 'halls.id')
                    ->where('film_sessions.film_id', $film->id)
                    ->whereDate('film_sessions.date', $day)
                    ->select('halls.id as hall_id', 'halls.name as hall_name')
                    ->distinct()
                    ->get();

                $film->hallTimes = $hallTimes->map(function ($hall) use ($film, $day) {
                    return [
                        'hall_id' => $hall->hall_id,
                        'name' => $hall->hall_name,
                        'sessions' => DB::table('film_sessions')
                            ->where('film_id', $film->id)
                            ->where('hall_id', $hall->hall_id)
                            ->whereDate('date', $day)
                            ->select('id as session_id', 'start_time')
                            ->get(),
                    ];
                });

                return $film;
            });

        return response()->json($films);
    }

    public function getFilms() {
        $films = Film::select('id', 'name', 'duration', 'image')->get();
        
        return response()->json($films);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'origin' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|string',
        ]);

        $film = Film::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'origin' => $validated['origin'],
            'duration' => $validated['duration'],
            'image' => $validated['image'] ?? null,
        ]);

        return response()->json($film, 201);
    }
}
