<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hall;
use App\Models\HallSchema;

class HallController extends Controller {

    public function index() {
        return response()->json(Hall::select('id', 'name', 'x', 'y')->get());
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);
    
        $hall = Hall::create([
            'name' => $validated['name'],
            'x' => 0,
            'y' => 0
        ]);
        
        return response()->json([
            'hall' => $hall,
        ]);
    }

    public function read($id){
        $hall = Hall::find($id);

        if (!$hall) {
            return response()->json(['error' => 'Hall not found'], 404);
        }

        return response()->json(['x' => $hall->x, 'y' => $hall->y]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1',
            'seats' => 'required|array',
            'seats.*.index_x' => 'required|integer|min:0',
            'seats.*.index_y' => 'required|integer|min:0',
            'seats.*.status' => 'required|string|in:regular,vip,disabled',
        ]);

        $hall = Hall::find($id);

        if (!$hall) {
            return response()->json(['error' => 'Hall not found'], 404);
        }

        $hall->update($validated);

        //HallSchema create/update
        //if we have schema for this hall -> update it: delete all seats for this hall
        //after -> insert new seats for the hall
        $hallSchema = HallSchema::where('hall_id', $id)->delete();

        foreach ($validated['seats'] as $seat) {
            $seats[] = [
                'hall_id' => $hall->id,
                'index_x' => $seat['index_x'],
                'index_y' => $seat['index_y'],
                'status' => $seat['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        HallSchema::insert($seats);

        return response()->json(['message' => 'Hall updated successfully']);
    }

    public function delete($id) {
        $hall = Hall::find($id);

        if (!$hall) {
            return response()->json(['error' => 'Hall not found'], 404);
        }
    
        $hall->delete();
    
        return response()->json(['message' => 'Hall deleted successfully']);
    }
}
