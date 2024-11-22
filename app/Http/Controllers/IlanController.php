<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class IlanController extends Controller
{
    public function index(){

        $ilanlar = Ilan::where('status','1')->get();

        return view('ilan.ilanlar',compact('ilanlar'));
    }

    public function ilan_ekle(){

        return view('ilan.ilan_ekle');
    }

    public function ilan_ekle_post(Request $request){

        if($request->hasFile('file')){

                $url = "https://campusconnect.com.tr/public/ilan_image/";

                    $path = $request->file('file')->store('temp');
                    $file = $request->file('file');
                    $fileName = $file->getClientOriginalName();
                    $file->move(public_path('ilan_image'), $fileName);
                    $ilanData = [
                        "user_id"     => auth()->id(),
                        "name"        => $request->input('name'),
                        "description" => $request->input("description"),
                        "fiyat"       => $request->input("fiyat"),
                        "kategori"    => $request->input("category"),
                        "image"       => $url.$fileName,
                        "status"      => "0",
                        "created_at"  => now()
                    ];

                    Ilan::insert($ilanData);

                    return response()->json(['success' => true]);
                }
                elseif (empty($request->hasFile('file'))){
                    $ilanData = [
                        "user_id"     => auth()->id(),
                        "name"        => $request->input('name'),
                        "description" => $request->input("description"),
                        "fiyat"       => $request->input("fiyat"),
                        "kategori"    => $request->input("category"),
                        "image"       => "",
                        'status'      =>"0",
                        "created_at"  => now()
                    ];

                    Ilan::insert($ilanData);

                    return response()->json(['success' => true]);
                }               
                
                
        else{
            return response()->json(['error' => 'İlan eklenirken hata.']);

        }
    }//End

    // public function filter_ilanlar(Request $request) {
    //     $kategori = $request->kategori;
    //     $fiyat = $request->fiyat;
    
    //     // Filtreleme işlemleri burada yapılacak
    //     // Örneğin:
    //     $ilanlar = Ilan::where('kategori', $kategori)
    //                     ->where('fiyat', '<=', $fiyat)
    //                     ->get();
    
    //     return response()->json($ilanlar);
    // }
}
