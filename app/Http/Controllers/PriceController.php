<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller {

    public function read($hall_id){
        $price = Price::where('hall_id', $hall_id)->first();

        if (!$price) {
            return response()->json([
                'price' => null,
            ]);
        }

        return response()->json([
            'price' => $price,
        ]);
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'hall_id' => 'required|exists:halls,id',
            'regular' => 'required|numeric|min:0',
            'vip'     => 'required|numeric|min:0',
        ]);
    
        $price = Price::create($validated);
    
        return response()->json([
            'price' => $price,
        ]);
    }

    public function update(Request $request, $hall_id) {
        $validated = $request->validate([
            'regular' => 'nullable|numeric|min:0',
            'vip'     => 'nullable|numeric|min:0',
        ]);

        $price = Price::where('hall_id', $hall_id)->first();

        if (!$price) {
            return response()->json(['error' => 'Price not found for this hall'], 404);
        }

        $price->update($validated);

        return response()->json([
            'price' => $price,
        ]);
    }
}
