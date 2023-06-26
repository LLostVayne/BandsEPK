<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BandsEpk;

class HomeController extends Controller
{
    public function show()
    {
        $bands = '';

        try {
            $bands = BandsEpk::inRandomOrder()->limit(3)->get();
        } catch (\Exception $e) {
            $bands = null;
        }

        return view('home', compact('bands'));
    }
}