<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class CityController extends Controller
{
    public function index(){
        return view('city.cities');
    }//End

    public function fetchCities(Request $request)
    {
        $cities = DB::table('cities')->paginate(20);

        $cities_topics_count = DB::table('cities_topics')
            ->select('city_id', DB::raw('COUNT(*) as count'))
            ->groupBy('city_id')
            ->pluck('count', 'city_id')
            ->toArray();

        return response()->json([
            'cities' => $cities,
            'cities_topics_count' => $cities_topics_count,
            'links' => $cities->links('pagination::bootstrap-4')->render()  
        ]);
    }
    public function show($slug){
    
        $city = City::where('slug', $slug)->first();
        $city_free_zone_topics = DB::table('cities_topics')
            ->where('city_id',$city->id)
            ->where('category','free-zone')
            ->get();
        
        $city_free_zone_topics_count = DB::table('cities_topics')
            ->select('topic_title', 'topic_title_slug', DB::raw('COUNT(*) as count'))
            ->where('city_id',$city->id)
            ->where('category','free-zone')
            ->groupBy('topic_title', 'topic_title_slug')
            ->get();      

            // dd($city_free_zone_topics_count);
        
        if (!$city) {
            abort(404, 'Şehir bulunamadı');
        }

        return view('forum.about_cities.index', compact('city','city_free_zone_topics','city_free_zone_topics_count'));
    }//End

    public function topicComments($slug)
    {
        try {
            // if slug is empty
            if (empty($slug)) {
                return redirect()->back()->withErrors('Slug değeri sağlanmadı.');
            }

            $topicsQuery = CityTopic::where('topic_title_slug', $slug);

            if ($topicsQuery->count() === 0) {
                abort(404, 'Bu slug ile ilişkili bir konu bulunamadı.');
            }

            $comments         = $topicsQuery->paginate(9);
            $topicTitle       = $comments->first()->topic_title ?? 'Başlık Yok';
            $topicTitleSlug   = $comments->first()->topic_title_slug ?? 'Slug Yok';
            $city_id          = $comments->first()->city_id;
            $comment_category = $comments->first()->category;

            $cities_topics = DB::table('cities_topics')
                ->where('city_id',$city_id)
                ->select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
                ->groupBy('topic_title', 'topic_title_slug')
                ->get();

            // `forum.university_topic` Blade dosyasına verileri döndür
            return view('city.city_topic', compact('topicTitle', 'comments', 'cities_topics', 'topicTitleSlug','city_id','comment_category'));

        } catch (\Exception $e) {
            Log::error('UniversityController:topicComments fonksiyonu hata verdi: ', [
                'error' => $e->getMessage(),
                'slug' => $slug,
            ]);

            return redirect()->back()->withErrors('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
        }
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

    public function getCityCategoryTopicContent(Request $request){
        $category = $request->input('category');
        $cityId = $request->input('cityId');

        $topics = DB::table('cities_topics')
            ->where('city_id',$cityId)
            ->where('category',$category)
            ->get();

            return response()->json(['topics' => $topics]);
    }//End

    public function addCityTopic(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'topic_title' => 'required|string|max:255',
            'comment' => 'required|string',
            'category' => 'required|string',
            'cityId' => 'required|integer|exists:cities,id',
        ]);
    
        try {
            if (!Auth::check()) {
                return redirect()->back()->withErrors(['error' => 'Oturum açmanız gerekiyor.']);
            }
    
            DB::table('cities_topics')->insert([
                'created_by'       => Auth::id(),
                'user_id'          => Auth::id(),
                'city_id'          => $validatedData['cityId'],
                'category'         => $validatedData['category'],
                'topic_title'      => $validatedData['topic_title'],
                'topic_title_slug' => Str::slug($validatedData['topic_title']),
                'comment'          => $validatedData['comment'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
    
            Log::info('City topic created successfully', [
                'user_id' => Auth::id(),
                'city_id' => $validatedData['cityId'],
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
