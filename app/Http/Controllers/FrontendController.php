<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Support\TravelData;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = TravelData::all();

        return view('home.index', $data);
    }

    public function destinations()
    {
        $data = TravelData::all();

        return view('home.destinations', $data);
    }

    public function packages(Request $request)
    {
        $data = TravelData::all();

        // Merge any packages saved to the database (via admin) with the static catalog.
        $dbPackages = Package::with('features')->get();
        if ($dbPackages->isNotEmpty()) {
            $data['packages'] = $dbPackages->map(function ($p) {
                return [
                    'id' => $p->id,
                    'title' => $p->title,
                    'country' => $p->country,
                    'price' => $p->price,
                    'rating' => $p->rating,
                    'days' => $p->days,
                    'image' => $p->image,
                    'description' => $p->description,
                    'details' => $p->features->pluck('feature')->all(),
                    'category' => $p->category,
                ];
            })->all();
        }

        return view('home.packages', $data);
    }

    public function world()
    {
        $data = TravelData::all();

        return view('home.world', $data);
    }
}
