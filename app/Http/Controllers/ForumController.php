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
            'title' => 'required|string|max:255',
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
                return response()->json([
                    'status' => 'error',
                    'message' => 'Slug değeri sağlanmadı.',
                ], 400);
            }

            $comments = GeneralTopic::where('topic_title_slug', $slug)->get();

            if ($comments->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Bu slug ile ilişkili bir konu veya yorum bulunamadı.',
                ], 404);
            }

            $topicTitle = $comments->first()->topic_title;

            return response()->json([
                'status' => 'success',
                'data' => [
                    'topic_title' => $topicTitle,
                    'comments' => $comments->map(function ($comment) {
                        return [
                            'id' => $comment->id,
                            'comments' => $comment->comments,
                            'created_at' => $comment->created_at->toDateTimeString(),
                            'updated_at' => $comment->updated_at->toDateTimeString(),
                        ];
                    }),
                ],
            ], 200);

        } catch (\Exception $e) {
            
            Log::error('topicComments fonksiyonu hata verdi: ', [
                'error' => $e->getMessage(),
                'slug' => $slug,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.',
            ], 500);
        }
    }//End

    public function getRandomTopics()
    {
        try {
            // Kullanıcının yetkisi kontrol edilir
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Yetkisiz erişim.'
                ], 403);
            }
    
            // Veritabanından rastgele konular çekilir
            $randomTopics = GeneralTopic::with('user')
                ->whereNotNull('created_by') // Sadece created_by dolu olanlar
                ->inRandomOrder()
                ->limit(10)
                ->get();
    
            // Eğer sonuç boşsa, kullanıcıya bilgi verilir
            if ($randomTopics->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gösterilecek konu bulunamadı.',
                    'data' => []
                ], 200);
            }
    
            // Başarıyla çekilen veriler döndürülür
            return response()->json([
                'success' => true,
                'message' => 'Konular başarıyla alındı.',
                'data' => $randomTopics
            ], 200);
    
        } catch (\Throwable $e) {
            // Hata loglama (kullanıcıya detay verilmez)
            Log::error('Rastgele konular alınırken hata oluştu:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            // Genel bir hata mesajı ile geri dönüş yapılır
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.'
            ], 500);
        }
    }//End
    
}   
