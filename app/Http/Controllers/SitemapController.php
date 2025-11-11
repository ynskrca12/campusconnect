<?php

namespace App\Http\Controllers;

use App\Models\GeneralTopic;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\City;
use App\Models\CityTopic;
use App\Models\UniversityTopic;
use App\Models\Blog;

class SitemapController extends Controller
{
    public function index()
    {
        $universities = University::all();
        $cities = City::all();
        $general_topics = GeneralTopic::all();
        $universities_topics = UniversityTopic::all();
        $cities_topics = CityTopic::all();
        $blogs = Blog::all();

        return response()->view('sitemap', compact('universities', 'cities', 'general_topics', 'universities_topics', 'cities_topics', 'blogs'))
                         ->header('Content-Type', 'text/xml');
    }
}
