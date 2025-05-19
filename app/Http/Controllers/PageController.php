<?php

namespace App\Http\Controllers;

use App\Mail\IncomingSupportMail;
use App\Models\GeneralTopic;
use App\Models\Support;
use App\Models\Blog;
use App\Models\UniversityTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\BlogComment;
use Exception;
use Illuminate\Validation\ValidationException;



class PageController extends Controller
{
    public function home(){
        $mostLikedTopicUniversity = UniversityTopic::where('likes','>',0)
        ->orderByDesc('likes')->first();

        $mostLikedTopicGeneral = GeneralTopic::where('likes','>',0)
        ->orderByDesc('likes')->first();

        $blogs = Blog::latest()->get();

        return view('home',compact('mostLikedTopicUniversity','mostLikedTopicGeneral','blogs'));
    }//End
    public function contact_us(){
        return view('pages.contact_us');
    }//End

    public function contact_submit(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        );
        // dd($data['name']);

        $support = new Support();
        $support->name = $request->name;
        $support->email = $request->email;
        $support->message = $request->message;
        $support->save();

        Mail::to('campusconnectiletisim@gmail.com')->send(new IncomingSupportMail($support));

        return redirect()->back()->with('success', 'Mesajınız başarıyla gönderildi!');
    }//End

    public function about_us(){
        return view('pages.about_us');
    }//End

    public function services(){
        return view('pages.services');
    }//End

    public function blogs(){
        $blogs = Blog::latest()->get();
        return view('blog.blogs',compact('blogs'));
    }//End

    public function blog($slug){
        $blogs = Blog::latest()->get();
        $blog = Blog::where('slug',$slug)->first();
        $blog_comments = BlogComment::where('blog_id',$blog->id)->get();

        return view('blog.blog',compact('blogs','blog','blog_comments'));
    }//End

    public function storeComment(Request $request)
    {
        try {
            
            if (!Auth::check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Yorum yapabilmek için giriş yapmalısınız.'
                ], 401);
            }

            $validator = Validator::make($request->all(), [
                'comment' => 'required|string|min:3',
                'blog_id' => 'required|integer|exists:blogs,id',
                'parent_id' => 'nullable|integer|exists:blog_comments,id'
            ]);

            // Validasyon hataları varsa
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Yorum gönderilemedi.',
                    'errors' => $validator->errors()
                ], 422);
            }


            $comment = BlogComment::create([
                'blog_id' => $request->blog_id,
                'user_id' => Auth::id(),
                'blog_comment' => strip_tags($request->comment),
                'parent_id' => $request->parent_id,
            ]);
              $user = auth()->user();

            return response()->json([
                'status' => 'success',
                'message' => 'Yorumunuz başarıyla gönderildi.',
                'comment' => [
                    'id' => $comment->id,
                    'user_image' => $user->user_image,
                    'user_name' => $user->name,
                    'comment' => $comment->blog_comment,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'parent_id' => $comment->parent_id,
                ]
            ], 201);

        } catch (Exception $e) {
           
            Log::error('Yorum kaydedilemedi: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'blog_id' => $request->input('blog_id'),
                'comment_excerpt' => substr($request->input('comment'), 0, 100)
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.'
            ], 500);
        }
    }//End

    public function replyComment(Request $request)
    {
        try {
            // Giriş kontrolü
            if (!Auth::check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Yorum yapabilmek için giriş yapmalısınız.',
                ], 401);
            }

            // Doğrulama
            $validated = $request->validate([
                'blog_id'      => ['required', 'integer', 'exists:blogs,id'],
                'parent_id'    => ['required', 'integer', 'exists:blog_comment,id'],
                'blog_comment' => ['required', 'string', 'max:1000'],
            ]);

            // Yorum oluşturma
            $comment = BlogComment::create([
                'blog_id'      => $validated['blog_id'],
                'user_id'      => Auth::id(),
                'blog_comment' => $validated['blog_comment'],
                'parent_id'    => $validated['parent_id'],
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Yorum yanıtı başarıyla eklendi.',
                'data'    => [
                    'comment_id' => $comment->id,
                ],
            ], 201);
        } catch (ValidationException $e) {
            // Doğrulama hataları
            return response()->json([
                'status'  => 'error',
                'message' => 'Geçersiz giriş.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Genel hata yakalama
            Log::error('Yorum yanıtı eklenirken hata oluştu.', [
                'error'     => $e->getMessage(),
                'user_id'   => Auth::id(),
                'request'   => $request->all(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.',
            ], 500);
        }
    }//End

    public function getComments($blog_id)
    {
        // Ana yorumları çekiyoruz (parent_id null olanlar)
        $comments = BlogComment::where('blog_id', $blog_id)
            ->whereNull('parent_id')
            ->with('user')
            ->latest()
            ->get();

        $formatted = $comments->map(function ($comment) {
            // Cevapları (yanıtları) manuel olarak çekiyoruz
            $replies = BlogComment::where('parent_id', $comment->id)
                ->with('user')
                ->orderBy('created_at')
                ->get()
                ->map(function ($reply) {
                    return [
                        'comment' => $reply->blog_comment,
                        'created_at' => $reply->created_at->diffForHumans(),
                        'username' => $reply->user->username,
                        'user_image' => $reply->user->user_image ?? 'default.png',
                    ];
                });

            return [
                'id' => $comment->id,
                'comment' => $comment->blog_comment,
                'created_at' => $comment->created_at->diffForHumans(),
                'username' => $comment->user->username,
                'user_image' => $comment->user->user_image ?? 'default.png',
                'replies' => $replies,
            ];
        });

        return response()->json(['comments' => $formatted]);
    }//End


}
