<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRoles;
use Illuminate\Support\Facades\Auth;
use App\Models\BandsEpk;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $bands = BandsEpk::whereJsonContains('managed_by',Auth::id())->get();
        return view('dashboard', compact('user', 'bands'));
    }

    public function edit(Request $request)
    {
        $band = BandsEpk::find($request->id);
        return view('editBand', compact('band'));
    }

    public function delete(Request $request)
    {
        $bandToDelete = BandsEpk::find($request->id);

        if ($bandToDelete::whereJsonContains('managed_by',Auth::id())) {
            BandsEpk::destroy($request->id);
        }
        return redirect()->route('dashboard');
    }

    public function handleEdit(Request $request)
    {
        $band = BandsEpk::find($request->id);

        if (in_array(Auth::id(), json_decode($band->managed_by))) {
            $image = ($request->file('bandPicture'));

            if (!empty($image)) {
                $imageData = $image->getContent();
                $imageName = time() . '_' . Str::random(10) . '.' . $request->file('bandPicture')->extension();
                Storage::disk('public')->put('Images/' . $imageName, $imageData);
                $band->image = $imageName;
            }

            if (!str_contains($request->youtubeLink, "embed")) {
                $band->youtube_link = "https://www.youtube.com/embed/" . explode("v=", $request->youtubeLink)[1];
            }
            $band->name = $request->bandName;
            $band->description = $request->description;
            $band->biography = $request->biography;
            $band->text_color = $request->text_color;
            $band->background_color = $request->background_color;

            $band->save();
        }

        return redirect()->route('dashboard');
    }

    public function permitAdminsView(Request $request)
    {
        $adminRoles = ModelHasRoles::select('model_id')->where('role_id', 1)->get();
        $users = Users::all();
        return view('permitAdminsView', compact('users', 'adminRoles'), ['name' => $request->band, 'id' => $request->id,'managed_by' => json_decode($request->managed_by,true)]);
    }

    public function handlePermitAdmins(Request $request)
    {
        $permitAdmins = [Auth::user()->id];
        $bands = BandsEpk::whereJsonContains('managed_by',Auth::id())->get();

        if ($request->has('values')) {
            foreach ($request->input('values') as $value) {
                array_push($permitAdmins, intval($value));
            }
        }
        $band = BandsEpk::find($request->id);
        $band->managed_by = $permitAdmins;
        $band->save();

        return redirect()->route('dashboard');
    }
}