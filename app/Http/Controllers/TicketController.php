<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Seat;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Services\QrCodeService;

class TicketController extends Controller {
    public function createTicket(Request $request) {
        $request->validate([
            'film_session_id' => 'required|exists:film_sessions,id',
            'film_name' => 'required|string',
            'hall_name' => 'required|string',
            'date' => 'required|string',
            'start_time' => 'required|string',
            'seats' => 'required|array',
            'seats.*.id' => 'required|exists:seats,id',
            'seats.*.index_x' => 'required|integer',
            'seats.*.index_y' => 'required|integer',
        ]);

        $seatDetails = collect($request->seats)
            ->map(fn($seat) => "row: {$seat['index_y']}, seat: {$seat['index_x']}")
            ->implode('; ');

        $qrData = "
            Film: {$request->film_name},
            Hall: {$request->hall_name},
            Date: {$request->date},
            Start time: {$request->start_time},
            Seats: {$seatDetails}
        ";

        $qrCodeFile = QrCodeService::generateQrCode($qrData, "{$request->film_session_id}"."{$request->seats[0]['id']}");

        //create ticket
        $ticket = Ticket::create([
            'qr_code' => $qrCodeFile,
            'film_session_id' => $request->film_session_id,
            'seat_ids' => json_encode(collect($request->seats)->pluck('id')->toArray()),
        ]);

        //update seats' status to 'purchased'
        $seats = Seat::whereIn('id', collect($request->seats)->pluck('id')->toArray())
            ->update(['status' => 'purchased']);

        return response()->json([
            'message' => 'Ticket was created successfully',
            'ticket' => $ticket,
            'qr_url' => asset("qr_codes/$qrCodeFile"),
        ]);
    }
}
