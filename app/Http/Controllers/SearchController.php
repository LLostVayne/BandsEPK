<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BandsEpk;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchPage()
    {
        return view('searchPage')->with('bands', array());
    }

    public function searchResults(Request $request)
    {
        $bands = [];
        $searchTerm = $request->searchBand;

        $bands = BandsEpk::where('name', 'LIKE', '%' . $searchTerm . '%')->get()->toArray();

        $foundBandNames = DB::table('bands_epk')
            ->whereRaw('SOUNDEX(`name`) = SOUNDEX(?)', [$searchTerm])
            ->pluck('name')
            ->toArray();

        $foundBands = BandsEpk::whereIn('name', $foundBandNames)->get()->toArray();
        
        $bands = array_unique(array_merge($bands,$foundBands),SORT_REGULAR);

        return view('searchPage', compact('bands'));
    }

}