<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function show($slug){
    
        $city = City::where('slug', $slug)->first();

        if (!$city) {
            abort(404, 'Şehir bulunamadı');
        }

        return view('forum.about_cities.index', compact('city'));
    }//End
}
