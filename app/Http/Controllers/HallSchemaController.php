<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HallSchema;

class HallSchemaController extends Controller {
    public function read($id){
        $seats = HallSchema::where('hall_id', $id)->get();

        return response()->json($seats, 200);
    }
}
