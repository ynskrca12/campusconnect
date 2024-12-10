<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GeneralTopic;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function index(){
        $universities = University::all();
        $general_topics = GeneralTopic::select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
            ->groupBy('topic_title', 'topic_title_slug')
            ->get();
        $cities = City::all();
        $randomTopics = GeneralTopic::with('user')
        ->whereNotNull('created_by')
        ->inRandomOrder()->limit(10)->get();
    
        return view('forum.index',compact('universities','general_topics','cities','randomTopics'));
    }//End

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
            
            // create new record
            $topic = new GeneralTopic();
            $topic->user_id          = $user->id; 
            $topic->created_by       = $user->id; 
            $topic->topic_title      = $request->input('title');
            $topic->topic_title_slug = Str::slug($request->input('title')); 
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
   
           $topicsQuery = GeneralTopic::where('topic_title_slug', $slug);
   
           
           if ($topicsQuery->count() === 0) {
            abort(404, 'Bu slug ile ilişkili bir konu bulunamadı.');
           }
            
            $comments = $topicsQuery->paginate(9);
            $topicTitle = $comments->first()->topic_title ?? 'Başlık Yok';


           $general_topics = GeneralTopic::select('topic_title', 'topic_title_slug', DB::raw('COUNT(topic_title_slug) as count'))
           ->groupBy('topic_title', 'topic_title_slug')
           ->get();
   
           // `forum.topics` Blade dosyasına verileri döndür
           return view('forum.topic', compact('topicTitle', 'comments','general_topics'));
   
       } catch (\Exception $e) {
   
           Log::error('topicComments fonksiyonu hata verdi: ', [
               'error' => $e->getMessage(),
               'slug' => $slug,
           ]);
   
           return redirect()->back()->withErrors('Bir hata oluştu. Lütfen daha sonra tekrar deneyin.');
       }
   }//End
   

    public function getRandomTopics()
    {
        try {    
            // get random topics from database
            $randomTopics = GeneralTopic::with('user')
                ->whereNotNull('created_by') 
                ->inRandomOrder()
                ->limit(10)
                ->get();
    
           
            if ($randomTopics->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gösterilecek konu bulunamadı.',
                    'data' => []
                ], 200);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Konular başarıyla alındı.',
                'data' => $randomTopics
            ], 200);
    
        } catch (\Throwable $e) {
            
            Log::error('Rastgele konular alınırken hata oluştu:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
            ], 500);
        }
    }//End

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
            if ($likeEntry) {
            
                if ($likeEntry->like === 1) {
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->delete();
                    $topic->decrement('likes');
                } else {
                    // Like if you haven't liked it before
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->update(['like' => 1]);
                    $topic->increment('likes');
                    $topic->decrement('dislikes');
                }
            } else {
                DB::table('general_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 1
                ]);
                $topic->increment('likes');
            }

            $topic->save();
            DB::commit();
            return response()->json(['likes' => $topic->likes]);

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
            if ($dislikeEntry) {
                if ($dislikeEntry->like === 0) {
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->delete();
                    $topic->decrement('dislikes');
                } else {
                  
                    DB::table('general_topics_likes')->where('user_id', $userId)->where('topic_id', $id)->update(['like' => 0]);
                    $topic->increment('dislikes');
                    $topic->decrement('likes');
                }
            } else {
                DB::table('general_topics_likes')->insert([
                    'user_id' => $userId,
                    'topic_id' => $id,
                    'like' => 0
                ]);
                $topic->increment('dislikes');
            }

            $topic->save();
             DB::commit();
            return response()->json(['dislikes' => $topic->dislikes]);
        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json(['error' => 'İşlem sırasında bir hata oluştu'], 500);
        }
    }//End


    
}   
