<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GeneralTopic;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ForumController extends Controller
{
    public function index(){
        $universities = University::all();
        $general_topics =GeneralTopic::all();
        $cities = City::all();
        
        return view('forum.index',compact('universities','general_topics','cities'));
    }//End

   
}
