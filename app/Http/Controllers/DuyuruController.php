<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Duyuru;
use Illuminate\Http\Request;

class DuyuruController extends Controller
{
    public function index(){

        $duyurular = Duyuru::orderBy('created_at', 'desc')->get();

        return view('duyuru.duyuru',compact('duyurular'));
    }
}
