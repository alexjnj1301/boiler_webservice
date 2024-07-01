<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use Illuminate\Http\Request;
use App\Models\Pixel;

class PixelController extends Controller
{
    public function index()
    {
        return response()->json(Pixel::all());
    }

    public function update(Request $request)
    {
        $pixel = Pixel::updateOrCreate(
            ['x' => $request->x, 'y' => $request->y],
            ['color' => $request->color]
        );

        event(new MyEvent($pixel));
        return response()->json($pixel);
    }
}
