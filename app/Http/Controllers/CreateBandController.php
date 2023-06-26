<?php

namespace App\Http\Controllers;

use App\Models\BandsEpk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class CreateBandController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'youtubeLink' => 'required|regex:/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=[A-Za-z0-9_-]{11}$/',
            'bandName' => 'required|string|max:255',
            'description' => 'required|string',
            'biography' => 'required|string',
            'bandPicture' => 'required|file|mimes:jpeg,jpg,png',
        ]);

        $band = new BandsEpk();

        $imageData = $request->file('bandPicture')->getContent();
        $imageName = time() . '_' . Str::random(10) . '.' . $request->file('bandPicture')->extension();

        $band->name = $request->bandName;
        $band->description = $request->description;
        $band->biography = $request->biography;
        $band->youtube_link = "https://www.youtube.com/embed/" . explode("v=", $request->youtubeLink)[1];
        $band->managed_by = json_encode(array(Auth::id()));
        $band->text_color = $request->text_color;
        $band->background_color = $request->background_color;
        $band->image = $imageName;

        Storage::disk('public')->put('Images/' . $imageName, $imageData);
        $band->save();

        return redirect()->route('dashboard');
    }

    public function createBandForm()
    {
        return view('createBandForm');
    }
}