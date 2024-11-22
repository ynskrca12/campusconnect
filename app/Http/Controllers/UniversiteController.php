<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Universite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UniversiteController extends Controller
{
    public function index(){
        $universiteler = Universite::all();
        return view('universite.universite',compact('universiteler'));
    }

    public function universite_detay($id){

         $universite = DB::table('universiteler')->where('id',$id)->first();

         $universite_yorumlar = DB::table('universite_yorum')
                                    ->where('universite_id',$universite->id)
                                    ->orderBy('created_at','desc')
                                    ->get();

        return view('universite.universite_detay',compact('universite','universite_yorumlar'));
    }

    public function devlet_universite_getir(Request $request){
        $universite_turu = $request->input('universite_turu');
        $devletUniversiteleri = Universite::where('turu', $universite_turu)->get();
        return json_decode($devletUniversiteleri);
    }


    public function vakif_universite_getir($universite_turu){
        $vakifUniversiteleri = Universite::where('turu',$universite_turu)->get();

        return json_encode($vakifUniversiteleri);
    }
}
