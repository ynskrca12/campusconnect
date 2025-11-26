<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;


class CityController extends Controller
{
    public function index(){
        return view('city.cities');
    }//End

    public function fetchCities(Request $request)
    {
        $query = DB::table('cities')->orderBy('title', 'asc');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $cities = $query->paginate(28);

        $cities_topics_count = CityTopic::select('city_id', DB::raw('COUNT(*) as count'))
            ->groupBy('city_id')
            ->pluck('count', 'city_id')
            ->toArray();

        return response()->json([
            'cities' => $cities,
            'cities_topics_count' => $cities_topics_count,
            'links' => $cities->appends(['search' => $request->search])->links('pagination::bootstrap-4')->render() 
        ]);
    }//End
    public function show($slug){
    
        $city = City::where('slug', $slug)->first();
        $city_free_zone_topics = CityTopic::where('city_id',$city->id)
            ->where('category','free-zone')
            ->orderBy('created_at', 'desc') 
            ->paginate('10');
        
        $getCityFreeZoneTopics = CityTopic::select('topic_title', 'topic_title_slug', DB::raw('COUNT(*) as count'))
            ->where('city_id',$city->id)
            ->where('category','free-zone')
            ->groupBy('topic_title', 'topic_title_slug')
            ->get();      

        $topicCount = $this->getCityCategoryCount($city->id);
        
        
        if (!$city) {
            abort(404, 'Şehir bulunamadı');
        }

        return view('forum.about_cities.index', compact('city','city_free_zone_topics','getCityFreeZoneTopics','topicCount'));
    }//End

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10;

        $cityId = $request->input('city_id');
        $category = $request->input('category');


        // En son oluşturulan yorumlara göre sırala
        $topics = CityTopic::with('user')
            ->where('city_id', $cityId)
            ->where('category', $category)
            // ->whereNotNull('created_by')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Eğer AJAX istek gelmişse, sadece partial view döndür
        if ($request->ajax()) {
            return response()->json([
                'html' => View::make('components.topic-list', compact('topics'))->render(),
                'hasMore' => $topics->hasMorePages(),
            ]);
        }

        // Normal istek için (fallback)
        return redirect()->route('forum');
    }

    private function getCityCategoryCount($cityId){
        $categories = ['free-zone', 'general-info', 'social-life', 'job-opportunities', 'question-answer'];
        $topicCouns = [];

        foreach ($categories as $category) {
            $topicCouns[$category] = CityTopic::where('city_id', $cityId)
                ->where('category', $category)
                ->count();
        }

        return $topicCouns;
    }//End

    public function topicComments($slug)
    {
        try {
            // if slug is empty
            if (empty($slug)) {
                return redirect()->back()->withErrors('Slug değeri sağlanmadı.');
            }

            $topicsQuery = CityTopic::with('user')->
            where('topic_title_slug', $slug);

            if ($topicsQuery->count() === 0) {
                abort(404, 'Bu slug ile ilişkili bir konu bulunamadı.');
            }

            $comments         = $topicsQuery->paginate(9);
            $topicTitle       = $comments->first()->topic_title ?? 'Başlık Yok';
            $topicTitleSlug   = $comments->first()->topic_title_slug ?? 'Slug Yok';
            $city_id          = $comments->first()->city_id;
            $comment_category = $comments->first()->category;

            $cities_topics = CityTopic::where('city_id',$city_id)
                ->select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
                ->groupBy('topic_title', 'topic_title_slug')
                ->get();

            $type = 'city';    
            $userLiked = DB::table('city_topics_likes')
                ->where('topic_id', $comments->first()->id)
                ->where('user_id', Auth::user()->id)
                ->where('like', 1)
                ->first();

            $userDisliked = DB::table('city_topics_likes')
                ->where('topic_id', $comments->first()->id)
                ->where('user_id', Auth::user()->id)
                ->where('like', 0)
                ->first();

            // `forum.university_topic` Blade dosyasına verileri döndür
            return view('city.city_topic', compact('topicTitle', 'comments', 'cities_topics', 'topicTitleSlug','city_id','comment_category','type','userLiked','userDisliked'));

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

        $topics = CityTopic::where('city_id',$cityId)
            ->where('category',$category)
            ->select('topic_title', 'topic_title_slug', DB::raw('COUNT(*) as count'))
            ->groupBy('topic_title', 'topic_title_slug')
            ->get();

            return response()->json(['topics' => $topics]);
    }//End

    public function getCityCategoryTopicContent(Request $request){
        $category = $request->input('category');
        $cityId = $request->input('cityId'); 

        $topics = CityTopic::
            where('city_id', $cityId)
            ->where('category', $category)
            ->join('users', 'cities_topics.user_id', '=', 'users.id')
            ->select(
            'cities_topics.id',
                    'cities_topics.topic_title',
                    'cities_topics.topic_title_slug',
                    'cities_topics.comment',
                    'cities_topics.created_at',
                    'cities_topics.user_id',
                    'cities_topics.likes',
                    'cities_topics.dislikes',
                    'users.username',
                    'users.user_image',
                    DB::raw('COUNT(*) as count')
        )
        ->groupBy(
            'cities_topics.id',
                    'cities_topics.topic_title',
                    'cities_topics.topic_title_slug',
                    'cities_topics.comment',
                    'cities_topics.created_at',
                    'cities_topics.user_id',
                    'cities_topics.likes',
                    'cities_topics.dislikes',
                    'users.username',
                    'users.user_image'
        )
        ->orderBy('cities_topics.created_at', 'desc')
        ->paginate('10');

              // Kullanıcı görsel yolu ve arka plan rengi ayarla
        $topics = $topics->map(function ($topic) {
            $imageName = $topic->user_image;

            $topic->user_image_path = $imageName
                ? asset('storage/profile_images/' . $imageName)
                : asset('assets/images/icons/user.png');

            $topic->bg_color = match ($imageName) {
                'man.png' => '#95bdff',
                'woman.png' => '#ffbdd3',
                default => 'transparent',
            };

            return $topic;
        });

            // Render Component HTMLs
        $html = '';
        foreach ($topics as $topic) {
            $html .= View::make('components.topic-box', [
                'topic' => $topic,
                'routeName' => 'city.topic.comments',
                'type' => 'city'
            ])->render();
        }

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
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

        $currentDate = strtolower(now()->format('dMY')); 
        $randomCode = strtolower(Str::random(5)); 

        $slug = Str::slug($request->input('topic_title')) . '-' . $currentDate . '-' . $randomCode;
    
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
                'topic_title_slug' => $slug,
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

    public function storeComment(Request $request)
    {
        try {
            
            if (!Auth::check()) {
                return response()->json(['error' => 'önce giriş yap hemşerim.'], 401);
            }

            $validator = Validator::make($request->all(), [
                'comment' => 'required|string|min:9|max:3000',
                'topic_title_slug' => 'required|string|exists:cities_topics,topic_title_slug',
            ], [
                'comment.required' => 'yorum yazmayı unuttun gardaşım benim.',
                'comment.min' => 'en az 3 karakter şartım var.',
                'comment.max' => '3000 karakterlik ne yazdın la',
                'topic_title_slug.required' => 'Konu başlığı gereklidir.',
                'topic_title_slug.string' => 'Konu başlığı geçerli bir metin olmalıdır.',
                'topic_title_slug.exists' => 'Seçilen konu başlığı geçerli değil.',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $topic = CityTopic::where('topic_title_slug', $request->input('topic_title_slug'))->first();

            if (!$topic) {
                return response()->json(['error' => 'Topic not found.'], 404);
            }

            $comment = new CityTopic();
            $comment->user_id          = Auth::id(); 
            $comment->topic_title      = $topic->topic_title; 
            $comment->topic_title_slug = $request->input('topic_title_slug'); 
            $comment->comment          = $request->input('comment'); 
            $comment->city_id          = $request->input('city_id'); 
            $comment->category         = $request->input('comment_category'); 
            $comment->created_at       = Carbon::now(); 

            $comment->save();

            return response()->json(['message' => 'Fikriniz gönderildi.'], 200);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error while saving the comment: ' . $e->getMessage());

            return response()->json(['error' => 'Bir hata oluştu.Lütfen tekrar deneyin.'], 500);
        }
    }//End

    public function like($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Lütfen giriş yapın'], 401);
        }

        $topic = DB::table('cities_topics')->where('id', $id)->first();

        if (!$topic) {
            return response()->json(['error' => 'Konu bulunamadı'], 404);
        }

        DB::beginTransaction();

        try {
            $removedFromLikes = false;
            $entry = DB::table('city_topics_likes')
                ->where('user_id', $userId)
                ->where('topic_id', $id)
                ->first();

            if ($entry) {
                if ($entry->like == 1) {
                    // Aynı like tekrar yapılmışsa, kaldır
                    DB::table('city_topics_likes')
                        ->where('user_id', $userId)
                        ->where('topic_id', $id)
                        ->delete();

                    DB::table('cities_topics')->where('id', $id)->decrement('likes');
                    $removedFromLikes = true;
                } elseif ($entry->like == 0) {
                    // Daha önce dislike yapılmışsa, dislike'ı kaldır ve like ekle
                    DB::table('city_topics_likes')
                        ->where('user_id', $userId)
                        ->where('topic_id', $id)
                        ->update([
                            'like' => 1,
                            'updated_at' => now()
                        ]);

                    DB::table('cities_topics')->where('id', $id)->increment('likes');
                    DB::table('cities_topics')->where('id', $id)->decrement('dislikes');
                }
            } else {
                // İlk kez like yapılıyorsa
                DB::table('city_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::table('cities_topics')->where('id', $id)->increment('likes');
            }

            DB::commit();

            $updated = DB::table('cities_topics')->where('id', $id)->first();

            $userLikeStatus = DB::table('city_topics_likes')
            ->where('user_id', $userId)
            ->where('topic_id', $id)
            ->first();

            return response()->json([
                'likes' => $updated->likes,
                'dislikes' => $updated->dislikes,
                'removedFromLikes' => $removedFromLikes,
                'user_liked' => $userLikeStatus && $userLikeStatus->like == 1

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'İşlem sırasında bir hata oluştu'], 500);
        }
    }


    public function dislike($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Lütfen giriş yapın'], 401);
        }

        $topic = DB::table('cities_topics')->where('id', $id)->first();

        if (!$topic) {
            return response()->json(['error' => 'Konu bulunamadı'], 404);
        }

        DB::beginTransaction();

        try {
            $removedFromLikes = false;
            $entry = DB::table('city_topics_likes')
                ->where('user_id', $userId)
                ->where('topic_id', $id)
                ->first();

            if ($entry) {
                if ($entry->like == 0) {
                    // Aynı dislike tekrar yapılmışsa, kaldır
                    DB::table('city_topics_likes')
                        ->where('user_id', $userId)
                        ->where('topic_id', $id)
                        ->delete();

                    DB::table('cities_topics')->where('id', $id)->decrement('dislikes');
                } elseif ($entry->like == 1) {
                    // Daha önce like yapılmışsa, like'ı kaldır ve dislike ekle
                    DB::table('city_topics_likes')
                        ->where('user_id', $userId)
                        ->where('topic_id', $id)
                        ->update([
                            'like' => 0,
                            'updated_at' => now()
                        ]);

                    DB::table('cities_topics')->where('id', $id)->increment('dislikes');
                    DB::table('cities_topics')->where('id', $id)->decrement('likes');
                    $removedFromLikes = true;
                }
            } else {
                // İlk kez dislike yapılıyorsa
                DB::table('city_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::table('cities_topics')->where('id', $id)->increment('dislikes');
            }

            DB::commit();

            $updated = DB::table('cities_topics')->where('id', $id)->first();

            $userDislikeStatus = DB::table('city_topics_likes')
                ->where('user_id', $userId)
                ->where('topic_id', $id)
                ->first();

            return response()->json([
                'likes' => $updated->likes,
                'dislikes' => $updated->dislikes,
                'removedFromLikes' => $removedFromLikes,
                'user_disliked' => $userDislikeStatus && $userDislikeStatus->like == 0

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'İşlem sırasında bir hata oluştu'], 500);
        }
    }


    
}
