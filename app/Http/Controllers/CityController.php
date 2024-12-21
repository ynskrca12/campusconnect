<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CityController extends Controller
{
    public function show($slug){
    
        $city = City::where('slug', $slug)->first();
        $city_free_zone_topics = DB::table('cities_topics')
            ->where('city_id',$city->id)
            ->where('category','serbest_bolge')
            ->get();

        if (!$city) {
            abort(404, 'Şehir bulunamadı');
        }

        return view('forum.about_cities.index', compact('city','city_free_zone_topics'));
    }//End

    public function getCityCategoryTopics(Request $request){
        $category = $request->input('category');
        $cityId = $request->input('cityId');

        $topics = DB::table('cities_topics')
            ->where('city_id',$cityId)
            ->where('category',$category)
            ->select('topic_title', 'topic_title_slug')
            ->get();

            return response()->json(['topics' => $topics]);
    }//End
}
