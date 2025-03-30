<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FilmSession;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\Price;
use App\Models\HallSchema;
use Carbon\Carbon;

class FilmSessionController extends Controller {
    public function getSessionInfo($session_id) {
        $session = FilmSession::find($session_id);

        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $film = Film::where('id', $session->film_id)->first(['id', 'name']);

        $hall = Hall::where('id', $session->hall_id)->first(['id', 'name', 'x', 'y']);

        $seats = Seat::where('film_session_id', $session_id)->get();

        $price_vip = Price::where('hall_id', $session->hall_id)->value('vip');
        $price_regular = Price::where('hall_id', $session->hall_id)->value('regular');

        return response()->json([
            'id' => $session->id,
            'date' => $session->date,
            'start_time' => $session->start_time,
            'film' => $film,
            'hall' => $hall,
            'seats' => $seats,
            'price_vip' => $price_vip,
            'price_regular' => $price_regular,
        ])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }

    public function getSessionsByDay(Request $request) {
        $date = $request->query('date');

        $sessions = FilmSession::whereDate('date', $date)
            ->join('halls', 'film_sessions.hall_id', '=', 'halls.id')
            ->join('films', 'film_sessions.film_id', '=', 'films.id')
            ->select(
                'film_sessions.hall_id',
                'halls.name as hall_name',
                'film_sessions.film_id',
                'films.name as film_name',
                'films.duration as duration',
                'film_sessions.start_time',
                'film_sessions.id'
            )
            ->orderBy('film_sessions.start_time', 'asc')
            ->get();
    
        //group sessions by hall_id and format the response
        $grouped = $sessions->groupBy('hall_id')->map(function($items, $hall_id) {
            return [
                'hall_id' => $hall_id,
                'name' => $items->first()->hall_name,
                'sessions' => $items->map(function($item) {
                    return [
                        'id' => $item->id,
                        'start_time' => $item->start_time,
                        'film' => [
                            'id' => $item->film_id,
                            'name' => $item->film_name,
                            'duration' => $item->duration,
                        ]
                    ];
                })->values()
            ];
        })->values();
    
        return response()->json($grouped);
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'hall_id' => 'required|exists:halls,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);
    
        $session = FilmSession::create([
            'film_id' => $validated['film_id'],
            'hall_id' => $validated['hall_id'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
        ]);

        //create seats from HallSchema
        $hallSchema = HallSchema::where('hall_id', $validated['hall_id'])->get();

        $seats = $hallSchema->map(function ($schema) use ($session) {
            return [
                'hall_id' => $session->hall_id,
                'film_session_id' => $session->id,
                'index_x' => $schema->index_x,
                'index_y' => $schema->index_y,
                'status' => $schema->status === 'disabled' ? 'disabled' : 'available',
                'is_vip' => $schema->status === 'vip',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        Seat::insert($seats->toArray());
    
        return response()->json($session, 201);
    }

    public function togglesale(Request $request)
    {
        $request->validate([
            'active' => 'required|boolean',
        ]);
    
        $activeStatus = $request->active ? 'active' : 'draft';
    
        FilmSession::query()->update(['status' => $activeStatus]);
    
        return response()->json([
            'message' => $activeStatus === 'active' 
                ? 'All sessions activated for ticket sales.' 
                : 'Ticket sales deactivated for all sessions.',
            'status' => $activeStatus,
        ]);
    }

    public function getAvailableStartTimes(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'hall_id' => 'required|exists:halls,id',
            'date' => 'required|date',
        ]);

        $hallId = $request->hall_id;
        $date = $request->date;

        //hall working hours
        $hallOpeningTime = Carbon::createFromTime(9, 0);  // Example: 9:00 AM
        $hallClosingTime = Carbon::createFromTime(23, 0); // Example: 11:00 PM

        //all existing sessions for that hall and date
        $sessions = FilmSession::where('hall_id', $hallId)
            ->where('date', $date)
            ->orderBy('start_time')
            ->get();

        $availableTimes = [];
        $currentTime = $hallOpeningTime;

        while ($currentTime->addHour()->lessThanOrEqualTo($hallClosingTime)) {
            $isSlotAvailable = true;

            foreach ($sessions as $session) {
                $sessionStart = Carbon::parse($session->start_time);
                $sessionEnd = $sessionStart->copy()->addMinutes($session->film->duration);

                if ($currentTime->between($sessionStart, $sessionEnd)) {
                    $isSlotAvailable = false;
                    break;
                }
            }

            if ($isSlotAvailable) {
                $availableTimes[] = $currentTime->format('H:i');
            }
        }

        return response()->json(['available_times' => $availableTimes]);
    }
}
