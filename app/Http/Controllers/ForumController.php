<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GeneralTopic;
use App\Models\UniversityTopic;
use App\Models\CityTopic;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class ForumController extends Controller
{
    public function index(){
         
        $general_topics = GeneralTopic::select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
            ->groupBy('topic_title', 'topic_title_slug')
            ->get();
         
        $latestTopics = GeneralTopic::with('user')
            ->whereNotNull('created_by')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('forum.index',compact('general_topics','latestTopics'));
    }//End

    // AJAX ile sonraki yorumları getirecek
    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 10;
        $userId = auth()->id();

        // Topics'i çek
        $topics = GeneralTopic::with('user')
            ->whereNotNull('created_by')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Her topic için beğeni durumunu ekle
        $topics->getCollection()->transform(function ($topic) use ($userId) {
            if ($userId) {
                $userLike = DB::table('general_topics_likes')
                    ->where('topic_id', $topic->id)
                    ->where('user_id', $userId)
                    ->first();
                
                $topic->userLiked = $userLike && $userLike->like == 1;
                $topic->userDisliked = $userLike && $userLike->like == 0;
            } else {
                $topic->userLiked = false;
                $topic->userDisliked = false;
            }
            
            return $topic;
        });

        // Eğer AJAX istek gelmişse, sadece partial view döndür
        if ($request->ajax()) {
            $html = '';
            foreach ($topics as $topic) {
                $html .= View::make('components.topic-box', [
                    'topic' => $topic,
                    'routeName' => 'topic.comments', // ← Route adını kontrol et
                    'type' => 'general'
                ])->render();
            }

            return response()->json([
                'html' => $html,
                'hasMore' => $topics->hasMorePages(),
            ]);
        }

        // Normal istek için (fallback)
        return redirect()->route('forum');
    }

   public function createTopicGeneralForum(Request $request){
        
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kullanıcı giriş yapmamış.',
            ], 401);
        }

        $user = Auth::user();

        // verify incoming data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:80',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {

             // Check if the user has already created a topic with the same title
                $existingTopic = GeneralTopic::where('created_by', $user->id)
                ->where('topic_title', $request->input('title'))
                ->first();

            if ($existingTopic) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bu başlık altında zaten bir konu oluşturmuşsunuz.',
                ], 400);
            }

            $slug = Str::slug($request->input('title'));

            $currentDate = strtolower(now()->format('dMY')); 
            $randomCode = strtolower(Str::random(5)); 

            $slug = Str::slug($request->input('title')) . '-' . $currentDate . '-' . $randomCode;
            
            // create new record
            $topic = new GeneralTopic();
            $topic->user_id          = $user->id; 
            $topic->created_by       = $user->id; 
            $topic->topic_title      = $request->input('title');
            $topic->topic_title_slug = $slug;
            $topic->comment          = $request->input('content'); 
            $topic->created_at       = now(); 
            $topic->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Gündem başarıyla oluşturuldu.',
                'data' => $topic,
            ], 201);

        } catch (\Exception $e) {
            // keep a log record in case of error
            Log::error('Gündem oluşturulurken hata oluştu: ', [
                'error' => $e->getMessage(),
                'user_id' => $user->id,
                'request' => $request->all(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Gündem oluşturulurken bir hata oluştu. Lütfen tekrar deneyin.',
            ], 500);
        }    
   }//End

    public function topicComments($slug)
    {
        try {
            // if slug is empty
            if (empty($slug)) {
                return redirect()->back()->withErrors('Slug değeri sağlanmadı.');
            }

            $userId = auth()->id(); // ← NULL olabilir

            $topicsQuery = GeneralTopic::with('user')
                ->where('topic_title_slug', $slug);

            if ($topicsQuery->count() === 0) {
                abort(404, 'Bu slug ile ilişkili bir konu bulunamadı.');
            }

            $comments = $topicsQuery->paginate(9);
            
            // HER COMMENT İÇİN BEĞENİ DURUMUNU EKLE
            $comments->getCollection()->transform(function ($comment) use ($userId) {
                if ($userId) {
                    $userLike = DB::table('general_topics_likes')
                        ->where('topic_id', $comment->id)
                        ->where('user_id', $userId)
                        ->first();
                    
                    $comment->userLiked = $userLike && $userLike->like == 1;
                    $comment->userDisliked = $userLike && $userLike->like == 0;
                } else {
                    $comment->userLiked = false;
                    $comment->userDisliked = false;
                }
                
                return $comment;
            });

            $topicTitle = $comments->first()->topic_title ?? 'Başlık Yok';
            $topicTitleSlug = $comments->first()->topic_title_slug ?? 'Slug Yok';

            $general_topics = GeneralTopic::select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
                ->groupBy('topic_title', 'topic_title_slug')
                ->get();

            return view('forum.topic', compact('topicTitle', 'comments', 'general_topics', 'topicTitleSlug'));

        } catch (\Exception $e) {
            Log::error('topicComments fonksiyonu hata verdi: ', [
                'error' => $e->getMessage(),
                'slug' => $slug,
            ]);

            return redirect()->back()->withErrors('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
        }
    }
   
   public function storeComment(Request $request)
    {
        try {
            
            if (!Auth::check()) {
                return response()->json(['error' => 'Please log in.'], 401);
            }

            // Validate the comment input
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string|min:2|max:5000',
                'topic_title_slug' => 'required|string|exists:general_topics,topic_title_slug', 
            ]);

            // If validation fails, return the first validation error
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            $topic = GeneralTopic::where('topic_title_slug', $request->input('topic_title_slug'))->first();

            if (!$topic) {
                return response()->json(['error' => 'Topic not found.'], 404);
            }

            // Create a new comment instance and populate its fields
            $comment = new GeneralTopic();
            $comment->user_id = Auth::id(); 
            $comment->topic_title = $topic->topic_title; 
            $comment->topic_title_slug = $request->input('topic_title_slug'); 
            $comment->comment = $request->input('comment'); 
            $comment->created_at = Carbon::now(); 

            $comment->save();

            return response()->json(['message' => 'Fikriniz gönderildi.'], 200);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error while saving the comment: ' . $e->getMessage());

            return response()->json(['error' => 'Bir hata oluştu.Lütfen tekrar deneyin.'], 500);
        }
    }//End


    public function getRandomTopics()
    {
        try {
            // Rastgele konuları çek
            $randomTopics = GeneralTopic::with('user')
                ->whereNotNull('created_by')
                ->inRandomOrder()
                ->limit(10)
                ->get();

            if ($randomTopics->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'html' => '<p class="text-muted">Gösterilecek konu bulunamadı.</p>'
                ], 200);
            }

            // Tüm topic'leri component olarak render et
            $html = '';
            foreach ($randomTopics as $topic) {
                $html .= view('components.topic-box', ['topic' => $topic, 'type' => 'general'])->render();
            }

            return response()->json([
                'success' => true,
                'html' => $html
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Rastgele konular alınırken hata oluştu:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'html' => '<p class="text-danger">Bir hata oluştu. Lütfen daha sonra tekrar deneyin.</p>'
            ], 500);
        }
    }


    public function like($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Lütfen giriş yapın'], 401);
        }

        $topic = GeneralTopic::findOrFail($id);
        $likeEntry = DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->first();

        DB::beginTransaction();

        try {
            $removedFromLikes = false;
            if ($likeEntry) {
                if ($likeEntry->like === 1) {
                    // Eğer zaten beğenmişse geri al
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->delete();
                    $topic->decrement('likes'); 
                    $liked = false;
                    $removedFromLikes = true; 
                } else {
                    // Beğeniyi güncelle (Dislike'ı kaldır, Like ekle)
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->update(['like' => 1,'updated_at' => Carbon::now()]);
                    $topic->increment('likes');
                    $topic->decrement('dislikes');
                    $liked = true;
                }
            } else {
                // Yeni bir beğeni ekle
                DB::table('general_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $topic->increment('likes');
                $liked = true;
            }

            // $topic->save();      
            DB::commit();

            $userLikeStatus = DB::table('general_topics_likes')
            ->where('user_id', $userId)
            ->where('topic_id', $id)
            ->first();

            return response()->json([
                'likes' => $topic->likes,
                'dislikes' => $topic->dislikes,
                'liked' => $liked,
                'removedFromLikes' => $removedFromLikes,
                'user_liked' => $userLikeStatus && $userLikeStatus->like == 1
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'İşlem sırasında bir hata oluştu'], 500);
        }
    }//End

    public function dislike($id)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Lütfen giriş yapın'], 401);
        }

        $topic = GeneralTopic::findOrFail($id);
        $dislikeEntry = DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->first();

        DB::beginTransaction();

        try {
            $removedFromLikes = false;
            if ($dislikeEntry) {
                if ($dislikeEntry->like === 0) {
                    // Eğer zaten beğenmemişse geri al
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->delete();
                    $topic->decrement('dislikes');
                    $disliked = false;
                } else {
                    // Dislike'ı güncelle (Like'ı kaldır, Dislike ekle)
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->update(['like' => 0,'updated_at' => Carbon::now()]);
                    $topic->increment('dislikes');
                    $topic->decrement('likes');
                    $disliked = true;
                    $removedFromLikes = true;
                }
            } else {
                // Yeni bir dislike ekle
                DB::table('general_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                $topic->increment('dislikes');
                $disliked = true;
            }

            $topic->save();
            DB::commit();

            $userDislikeStatus = DB::table('general_topics_likes')
                ->where('user_id', $userId)
                ->where('topic_id', $id)
                ->first();

            return response()->json([
                'likes' => $topic->likes,
                'dislikes' => $topic->dislikes,
                'disliked' => $disliked,
                'removedFromLikes' => $removedFromLikes,
                'user_disliked' => $userDislikeStatus && $userDislikeStatus->like == 0
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'İşlem sırasında bir hata oluştu'], 500);
        }
    }//End

    public function deleteTopic(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('type');

        $userId = auth()->id();

        switch ($type) {
            case 'general':
                $topic = GeneralTopic::where('id', $id)->where('user_id', $userId)->first();
                break;
            case 'university':
                $topic = UniversityTopic::where('id', $id)->where('user_id', $userId)->first();
                break;
            case 'city':
                $topic = CityTopic::where('id', $id)->where('user_id', $userId)->first();
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Geçersiz tür.']);
        }

        if (!$topic) {
            return response()->json(['success' => false, 'message' => 'Yorum bulunamadı.']);
        }

        if (!empty($topic->created_by)) {
            switch ($type) {
                case 'general':
                    GeneralTopic::where('topic_title_slug', $topic->topic_title_slug)->delete();
                    break;
                case 'university':
                    UniversityTopic::where('topic_title_slug', $topic->topic_title_slug)->delete();
                    break;
                case 'city':
                    CityTopic::where('topic_title_slug', $topic->topic_title_slug)->delete();
                    break;
            }
        }

         $topic->delete();


        return response()->json(['success' => true, 'message' => 'Yorum başarıyla silindi.']);
    }

    
}   
