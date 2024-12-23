<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class UniversityController extends Controller
{
    public function index(){
        $universiteler = University::all();
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
        $devletUniversiteleri = University::where('turu', $universite_turu)->get();
        return json_decode($devletUniversiteleri);
    }


    public function vakif_universite_getir($universite_turu){
        $vakifUniversiteleri = University::where('turu',$universite_turu)->get();

        return json_encode($vakifUniversiteleri);
    }

    public function show($slug){
        
        $university = University::where('slug', $slug)->first();

        $univercity_free_zone_topics = DB::table('universities_topics')
            ->where('university_id',$university->id)
            ->where('category','free-zone')
            ->get();

        if (!$university) {
            abort(404, 'Üniversite bulunamadı');
        }

        return view('forum.about_universities.index',
         compact('university','univercity_free_zone_topics'));
    }//End

    public function getUnivercityCategoryTopics(Request $request){
        $category = $request->input('category');
        $univercityId = $request->input('univercityId');

        $topics = DB::table('universities_topics')
            ->where('university_id',$univercityId)
            ->where('category',$category)
            ->select('topic_title', 'topic_title_slug')
            ->get();

            return response()->json(['topics' => $topics]);
    }//End

    public function addUniversityTopic(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'topic_title' => 'required|string|max:255',
            'comment' => 'required|string',
            'category' => 'required|string',
            'universityId' => 'required|integer|exists:universiteler,id',
        ]);
    
        try {
            if (!Auth::check()) {
                return redirect()->back()->withErrors(['error' => 'Oturum açmanız gerekiyor.']);
            }
    
            DB::table('universities_topics')->insert([
                'created_by'       => Auth::id(),
                'user_id'          => Auth::id(),
                'university_id'    => $validatedData['universityId'],
                'category'         => $validatedData['category'],
                'topic_title'      => $validatedData['topic_title'],
                'topic_title_slug' => Str::slug($validatedData['topic_title']),
                'comment'          => $validatedData['comment'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
    
            Log::info('University topic created successfully', [
                'user_id' => Auth::id(),
                'university_id' => $validatedData['universityId'],
                'topic_title' => $validatedData['topic_title'],
            ]);
    
            return redirect()->back()->with('success', 'Konu başarıyla eklendi!');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error while adding university topic', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Veritabanı hatası oluştu. Lütfen daha sonra tekrar deneyiniz.']);
        } catch (\Exception $e) {
            // handle unexpected errors
            Log::error('Unexpected error while adding university topic', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
            return redirect()->back()->withErrors(['error' => 'Beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.']);
        }
    }//End
}
