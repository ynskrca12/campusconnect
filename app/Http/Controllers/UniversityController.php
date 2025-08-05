<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\UniversityTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;


class UniversityController extends Controller
{
    public function index(){
        // $universiteler = University::all();
        $universities = DB::table('universiteler')->get();
        $universities_topics_count = UniversityTopic::select('university_id', DB::raw('COUNT(*) as count'))
            ->groupBy('university_id')
            ->pluck('count', 'university_id')
            ->toArray();
        return view('universite.universite',compact('universities','universities_topics_count'));
    }

    public function show($slug){
        
        $university = University::where('slug', $slug)->first();

        $univercity_free_zone_topics = UniversityTopic::where('university_id',$university->id)
            ->where('category','free-zone')
            ->orderBy('created_at', 'desc')
            ->paginate('10');

        $getUnivercityFreeZoneTopics = universityTopic::select('topic_title', 'topic_title_slug', DB::raw('COUNT(*) as count'))
            ->where('university_id',$university->id)
            ->where('category','free-zone')
            ->groupBy('topic_title', 'topic_title_slug')
            ->get();
  
        $topicCount = $this->getUniversityCategoryCount($university->id);

        if (!$university) {
            abort(404, 'Üniversite bulunamadı');
        }

        return view('forum.about_universities.index',
         compact('university','univercity_free_zone_topics','getUnivercityFreeZoneTopics','topicCount'));
    }//End

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10;

        $universityId = $request->input('university_id');
        $category = $request->input('category');


        // En son oluşturulan yorumlara göre sırala
        $topics = UniversityTopic::with('user')
            ->where('university_id', $universityId)
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

    private function getUniversityCategoryCount($universityId){
        $categories = ['free-zone', 'general-info', 'departmant-programs', 'campus-life', 'question-answer'];
        $topicCouns = [];

        foreach ($categories as $category) {
            $topicCouns[$category] = UniversityTopic::where('university_id', $universityId)
                ->where('category', $category)
                ->count();
        }

        return $topicCouns;
    }//End

    public function getUnivercityCategoryTopics(Request $request){
        $category = $request->input('category');
        $univercityId = $request->input('univercityId');

        $topics = UniversityTopic::where('university_id', $univercityId)
        ->where('category', $category)
        ->select('topic_title','topic_title_slug',DB::raw('COUNT(*) as count'))
        ->groupBy('topic_title', 'topic_title_slug')
        ->get();

            return response()->json(['topics' => $topics]);
    }//End

    public function getUnivercityCategoryTopicContent(Request $request){
        $category = $request->input('category');
        $univercityId = $request->input('univercityId'); 

        $topics = UniversityTopic::
            where('university_id', $univercityId)
            ->where('category', $category)
            ->join('users', 'universities_topics.user_id', '=', 'users.id')
            ->select(
            'universities_topics.id',
                    'universities_topics.topic_title',
                    'universities_topics.topic_title_slug',
                    'universities_topics.comment',
                    'universities_topics.created_at',
                    'universities_topics.user_id',
                    'universities_topics.likes',
                    'universities_topics.dislikes',
                    'users.username',
                    'users.user_image',
                    DB::raw('COUNT(*) as count')
        )
        ->groupBy(
            'universities_topics.id',
                    'universities_topics.topic_title',
                    'universities_topics.topic_title_slug',
                    'universities_topics.comment',
                    'universities_topics.created_at',
                    'universities_topics.user_id',
                    'universities_topics.likes',
                    'universities_topics.dislikes',
                    'users.username',
                    'users.user_image'
        )
        ->orderBy('universities_topics.created_at', 'desc')
        ->paginate('10');

         // Görsel yolunu ve arka plan rengini ekleyelim
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
                'routeName' => 'university.topic.comments',
                'type' => 'university'
            ])->render();
        }

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
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

        $currentDate = strtolower(now()->format('dMY')); 
        $randomCode = strtolower(Str::random(5)); 

        $slug = Str::slug($request->input('topic_title')) . '-' . $currentDate . '-' . $randomCode;
    
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
                'topic_title_slug' => $slug,
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

    public function fetchUniversities(Request $request)
    {
        $query = DB::table('universiteler')->orderBy('universite_ad', 'asc');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('universite_ad', 'like', '%' . $request->search . '%');
        }

        $universities = $query->paginate(40);

        $universities_topics_count = UniversityTopic::select('university_id', DB::raw('COUNT(*) as count'))
            ->groupBy('university_id')
            ->pluck('count', 'university_id')
            ->toArray();

        return response()->json([
            'universities' => $universities,
            'universities_topics_count' => $universities_topics_count,
            'links' => $universities->appends(['search' => $request->search])->links('pagination::bootstrap-4')->render()
        ]);
    }


    public function like($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Giriş yapmalısınız'], 401);
        }

        $topic = DB::table('universities_topics')->where('id', $id)->first();

        if (!$topic) {
            return response()->json(['error' => 'Konu bulunamadı'], 404);
        }

        $existing = DB::table('university_topics_likes')
            ->where('user_id', $userId)
            ->where('topic_id', $id)
            ->first();

        DB::beginTransaction();

        try {
             $removedFromLikes = false;
            if ($existing) {
                if ($existing->like == 1) {
                    // Zaten beğenmişse, beğeniyi geri al
                    DB::table('university_topics_likes')
                        ->where('id', $existing->id)
                        ->delete();

                    DB::table('universities_topics')->where('id', $id)->decrement('likes');
                    $removedFromLikes = true;
                } else {
                    // Dislike'ı like olarak değiştir
                    DB::table('university_topics_likes')
                        ->where('id', $existing->id)
                        ->update([
                            'like' => 1,
                            'updated_at' => now()
                        ]);

                    DB::table('universities_topics')->where('id', $id)->increment('likes');
                    DB::table('universities_topics')->where('id', $id)->decrement('dislikes');
                }
            } else {
                // İlk kez beğeniyorsa
                DB::table('university_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::table('universities_topics')->where('id', $id)->increment('likes');
            }

            DB::commit();

            $updated = DB::table('universities_topics')->where('id', $id)->first();

            return response()->json([
                'likes' => $updated->likes,
                'dislikes' => $updated->dislikes,
                'removedFromLikes' => $removedFromLikes
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'İşlem hatası'], 500);
        }
    }
        
    public function dislike($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Giriş yapmalısınız'], 401);
        }

        $topic = DB::table('universities_topics')->where('id', $id)->first();

        if (!$topic) {
            return response()->json(['error' => 'Konu bulunamadı'], 404);
        }

        $existing = DB::table('university_topics_likes')
            ->where('user_id', $userId)
            ->where('topic_id', $id)
            ->first();

        DB::beginTransaction();

        try {
            $removedFromLikes = false;
            if ($existing) {
                if ($existing->like == 0) {
                    // Zaten dislike ise, geri al
                    DB::table('university_topics_likes')
                        ->where('id', $existing->id)
                        ->delete();

                    DB::table('universities_topics')->where('id', $id)->decrement('dislikes');
                } else {
                    // Like'dan dislike'a çevir
                    DB::table('university_topics_likes')
                        ->where('id', $existing->id)
                        ->update([
                            'like' => 0,
                            'updated_at' => now()
                        ]);

                    DB::table('universities_topics')->where('id', $id)->increment('dislikes');
                    DB::table('universities_topics')->where('id', $id)->decrement('likes');
                    $removedFromLikes = true;
                }
            } else {
                // İlk kez dislike yapıyorsa
                DB::table('university_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                DB::table('universities_topics')->where('id', $id)->increment('dislikes');
            }

            DB::commit();

            $updated = DB::table('universities_topics')->where('id', $id)->first();

            return response()->json([
                'likes' => $updated->likes,
                'dislikes' => $updated->dislikes,
                'removedFromLikes' => $removedFromLikes
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'İşlem hatası'], 500);
        }
    }

    public function topicComments($slug)
    {
        try {
            // if slug is empty
            if (empty($slug)) {
                return redirect()->back()->withErrors('Slug değeri sağlanmadı.');
            }

            $topicsQuery = UniversityTopic::with('user')->
            where('topic_title_slug', $slug);

            if ($topicsQuery->count() === 0) {
                abort(404, 'Bu slug ile ilişkili bir konu bulunamadı.');
            }

            $comments         = $topicsQuery->paginate(9);
            $topicTitle       = $comments->first()->topic_title ?? 'Başlık Yok';
            $topicTitleSlug   = $comments->first()->topic_title_slug ?? 'Slug Yok';
            $university_id    = $comments->first()->university_id;
            $comment_category = $comments->first()->category;

            $universities_topics = UniversityTopic::where('university_id',$university_id)
                ->select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
                ->groupBy('topic_title', 'topic_title_slug')
                ->get();

            // `forum.university_topic` Blade dosyasına verileri döndür
            return view('universite.university_topic', compact('topicTitle', 'comments', 'universities_topics', 'topicTitleSlug','university_id','comment_category'));

        } catch (\Exception $e) {
            Log::error('UniversityController:topicComments fonksiyonu hata verdi: ', [
                'error' => $e->getMessage(),
                'slug' => $slug,
            ]);

            return redirect()->back()->withErrors('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
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
                'topic_title_slug' => 'required|string|exists:universities_topics,topic_title_slug',
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

            $topic = UniversityTopic::where('topic_title_slug', $request->input('topic_title_slug'))->first();

            if (!$topic) {
                return response()->json(['error' => 'Topic not found.'], 404);
            }

            $comment = new UniversityTopic();
            $comment->user_id          = Auth::id(); 
            $comment->topic_title      = $topic->topic_title; 
            $comment->topic_title_slug = $request->input('topic_title_slug'); 
            $comment->comment          = $request->input('comment'); 
            $comment->university_id    = $request->input('university_id'); 
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
}
