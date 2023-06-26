<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BandsEpk;

class BandPageController extends Controller
{
    public function index(Request $request)
    {
        $band = BandsEpk::find($request->id);

        return view('bandPage', compact('band'))->with([
            'backgroundColor' => $band->background_color,
        ]);
    }
}