<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\City;

class SitemapController extends Controller
{
    public function index()
    {
        $universities = University::all();
        $cities = City::all();

        return response()->view('sitemap', compact('universities', 'cities'))
                         ->header('Content-Type', 'text/xml');
    }
}
