<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CityTopic;
use App\Models\GeneralTopic;
use App\Models\GeneralTopicsLike;
use App\Models\University;
use App\Models\UniversityTopicsLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Mail\EmailUpdatedNotification;
use App\Models\CityTopicsLike;
use App\Models\UniversityTopic;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function user_informations(){
        if (Auth::check()) {
            $user = Auth::user();
            $universities = University::all();
            
            return view("user.user_informations", compact('user','universities'));
        } else {
            return redirect('/login')->with('message', 'Lütfen giriş yapınız.');
        }
    }

     public function updateImage(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ],
        [
            'user_image.required' => 'Lütfen bir profil resmi yükleyin.',
            'user_image.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'user_image.mimes' => 'Yalnızca jpeg, png, jpg ve gif formatındaki resimler kabul edilir.',
            'user_image.max' => 'Resim boyutu 2MB\'dan büyük olmamalıdır.'
        ]);

        // Eğer önceden yüklenmiş bir dosya varsa sil
        if ($user->user_image && Storage::disk('public')->exists('profile_images/' . $user->user_image)) {
            Storage::disk('public')->delete('profile_images/' . $user->user_image);
        }

        // Dosyayı yükle ve ismini kaydet
        $file = $request->file('user_image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('profile_images', $filename, 'public');

        $path = $file->storeAs('profile_images', $filename, 'public');

        if (!$path) {
            return back()->withErrors(['user_image' => 'Dosya yüklenemedi.']);
        }

        // Kullanıcı modelini güncelle
        $user->user_image = $filename;
        $user->save();

        return redirect()->back()->with('success', 'Profil resmi başarıyla güncellendi.');
    }//End

    public function updateProfile(Request $request)
    {
        $request->validate([
            'field' => 'required|string',
            'value' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->field === 'username') {
                        if (User::where('username', $value)->where('id', '!=', auth()->id())->exists()) {
                            $fail('Bu kullanıcı adı zaten kullanımda!');
                        }
                    }
                }
            ]
        ]);
    
        $user = auth()->user();
        $user->{$request->field} = $request->value;
        $user->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Bilgileriniz başarıyla güncellendi.',
            'value' => $request->value
        ]);
    }//End

    public function checkUsername(Request $request)
    {
        $username = $request->get('username');
    
        // Kullanıcı adı zaten varsa response döndür
        $exists = User::where('username', $username)->exists();
    
        return response()->json(['exists' => $exists]);
    }//End
    
    public function checkEmail(Request $request)
    {
        $email = $request->email;

        $exists = User::where('email', $email)->exists();

        return response()->json([
            'available' => !$exists
        ]);
    }//End

    public function updateEmail(Request $request)
    {
        $user = auth()->user();
        $newEmail = $request->input('value');
        
        $token = Str::random(60); 
        $expiresAt = Carbon::now()->addMinutes(60); 

        $user->new_email = $newEmail;
        $user->email_verification_token = $token;
        $user->email_verification_token_expires_at = $expiresAt;
        $user->save();

        $verificationUrl = route('user.verify.email', ['token' => $token]);

        Mail::to($user->email)->send(new EmailUpdatedNotification($user, $verificationUrl));

        return response()->json(['status' => 'success', 'message' => 'Doğrulama e-postası gönderildi.']);
    }//End

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)
                    ->where('email_verification_token_expires_at', '>', now())
                    ->first();

        if (!$user) {
            return redirect()->route('home')->with('error', 'Geçersiz veya süresi dolmuş doğrulama bağlantısı.');
        }

        $user->email = $user->new_email; 
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->email_verification_token_expires_at = null; 
        $user->new_email = null; 
        $user->save();

        return redirect()->route('user.informations')->with('success', 'E-posta adresiniz başarıyla güncellenmiştir.');
    }//End
    
    public function my_statistics(){
        $user = Auth::user();
        $created_at = $user->created_at->format('d.m.Y');
        
        $statistics = [
            'myCommentsCount'          => $this->myCommentsCount(),
            'myLikesCount'             => $this->myLikesCount(),
            'myCommentsLikesCount'     => $this->myCommentsLikesCount(),
            'mostLikedTopicCity'       => $this->mostLikedTopicCity(),
            'mostLikedTopicUniversity' => $this->mostLikedTopicUniversity(),
            'mostLikedTopicGeneral'    => $this->mostLikedTopicGeneral(),
            'created_at'               => $created_at
        ];


        return view('user.my_statistics',
        compact('user','statistics'));
    }//End

    private function mostLikedTopicCity(){
        $user = Auth::user();

        $mostLikedTopicCity = CityTopic::where('user_id',$user->id)
        ->where('likes','>',0)
        ->orderByDesc('likes')->first();

        return $mostLikedTopicCity;
    }//End

    private function mostLikedTopicUniversity(){
        $user = Auth::user();

        $mostLikedTopicUniversity = UniversityTopic::where('user_id',$user->id)
        ->where('likes','>',0)
        ->orderByDesc('likes')->first();

        return $mostLikedTopicUniversity;
    }//End

    private function mostLikedTopicGeneral(){
        $user = Auth::user();

        $mostLikedTopicGeneral = GeneralTopic::where('user_id',$user->id)
        ->where('likes','>',0)
        ->orderByDesc('likes')->first();

        return $mostLikedTopicGeneral;
    }//End

    private function myCommentsCount(){
        $user = Auth::user();

        $my_cities_comments = CityTopic::where('user_id', $user->id)->get();

        $my_universities_comments = UniversityTopic::where('user_id', $user->id)->get();

        $my_general_comments = GeneralTopic::where('user_id', $user->id)->get();
    
        $my_comments = $my_cities_comments->merge($my_universities_comments)
        ->merge($my_general_comments)
        ->count();
        
        return $my_comments;
    }//End

    private function myLikesCount(){
        $user = Auth::user();

        $cities_topics_likes = CityTopicsLike::where('user_id', $user->id)
            ->with('topic')
            ->where('like','1')    
            ->get();

        $universities_topics_likes = UniversityTopicsLike::where('user_id', $user->id)
            ->with('topic')    
            ->where('like','1')    
            ->get(); 

        $general_topics_likes = GeneralTopicsLike::where('user_id', $user->id)
            ->with('topic')
            ->where('like','1')    
            ->get();    
            
        $liked_topics_count = $cities_topics_likes->merge($universities_topics_likes)
        ->merge($general_topics_likes)
        ->count();

        return $liked_topics_count;
    }//End

    private function myCommentsLikesCount(){
        $user = Auth::user();

        $my_cities_comments = CityTopic::where('user_id', $user->id)->sum('likes');

        $my_universities_comments = UniversityTopic::where('user_id', $user->id)->sum('likes');

        $my_general_comments = GeneralTopic::where('user_id', $user->id)->sum('likes');
    
        $sum_likes = $my_cities_comments + $my_universities_comments + $my_general_comments;
        
        return $sum_likes;
    }//End

    public function my_likes()
    {
        $user = Auth::user();

        $total_likes = $this->getLikedTopics($user)->count();
        // İlk sayfa verisi (sayfa=1)
        $liked_topics = $this->getLikedTopics($user)->forPage(1, 10);

        $total = $this->getLikedTopics($user)->count();

        return view('user.my_likes', compact('liked_topics', 'total', 'user', 'total_likes'));
    }

    public function load_more_likes(Request $request)
    {
        $page = (int) $request->get('page', 1);
        $user = Auth::user();

        $liked_topics = $this->getLikedTopics($user)->forPage($page, 10);

        return response()->json([
            'html' => view('user.partials.liked_topics', compact('liked_topics'))->render(),
            'hasMore' => $this->getLikedTopics($user)->count() > $page * 10
        ]);
    }

    private function getLikedTopics($user)
    {
        $cities_topics_likes = CityTopicsLike::where('user_id', $user->id)
            ->with('topic')
            ->where('like', '1')
            ->get()
            ->each(fn($item) => $item->type = 'city');

        $universities_topics_likes = UniversityTopicsLike::where('user_id', $user->id)
            ->with('topic')
            ->where('like', '1')
            ->get()
            ->each(fn($item) => $item->type = 'university');

        $general_topics_likes = GeneralTopicsLike::where('user_id', $user->id)
            ->with('topic')
            ->where('like', '1')
            ->get()
            ->each(fn($item) => $item->type = 'general');

        return $cities_topics_likes
            ->merge($universities_topics_likes)
            ->merge($general_topics_likes)
            ->sortByDesc(fn($topic) => $topic->topic->created_at)
            ->values(); // index sıfırlama
    }

    public function my_comments(Request $request)
        {
            $user = Auth::user();

            $perPage = 10;
            $page = $request->input('page', 1);

            $my_comments = $this->getUserComments($user)
                ->forPage($page, $perPage);

            $paginator = new LengthAwarePaginator(
                $my_comments,
                $this->getUserComments($user)->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            if ($request->ajax()) {
                return response()->json([
                    'html' => View::make('components.topic-list', ['topics' => $my_comments])->render(),
                    'hasMore' => $paginator->hasMorePages(),
                ]);
            }

            return view('user.my_comments', [
                'user' => $user,
                'my_comments' => $paginator
            ]);
        }

        /**
         * Kullanıcı yorumlarını collection olarak döner.
         */
        private function getUserComments($user): Collection
        {
            $my_cities_comments = CityTopic::where('user_id', $user->id)->get()
                ->map(function ($item) {
                    $item->type = 'city';
                    return $item;
                });

            $my_universities_comments = UniversityTopic::where('user_id', $user->id)->get()
                ->map(function ($item) {
                    $item->type = 'university';
                    return $item;
                });

            $my_general_comments = GeneralTopic::where('user_id', $user->id)->get()
                ->map(function ($item) {
                    $item->type = 'general';
                    return $item;
                });

            return collect(array_merge(
                $my_cities_comments->all(),
                $my_universities_comments->all(),
                $my_general_comments->all()
            ))->sortByDesc(fn($topic) => $topic->created_at)->values();
        }

    public function preview($id)
    {
        $user = User::findOrFail($id);
        
        $this->userCommentsCount($user->id);

        return response()->json([
            'username' => $user->username,
            'university' => $user->university,
            'joined_at' => $user->created_at->format('d.m.Y'),
            'user_image' => asset('storage/profile_images/' . ($user->user_image )),
            'user_comments_count' => $this->userCommentsCount($user->id)
        ]);
    }//End

     private function userCommentsCount($id){
        $user = User::findOrFail($id);

        $my_cities_comments = CityTopic::where('user_id', $user->id)->get();

        $my_universities_comments = UniversityTopic::where('user_id', $user->id)->get();

        $my_general_comments = GeneralTopic::where('user_id', $user->id)->get();
    
        $my_comments = $my_cities_comments->merge($my_universities_comments)
        ->merge($my_general_comments)
        ->count();
        
        return $my_comments;
    }//End


    public function profile($username)
    {
        // Kullanıcıyı bul
        $user = User::where('username', $username)->firstOrFail();
        
        // Toplam yorum sayıları
        $citiesCommentsCount = CityTopic::where('user_id', $user->id)->count();
        $universitiesCommentsCount = UniversityTopic::where('user_id', $user->id)->count();
        $generalCommentsCount = GeneralTopic::where('user_id', $user->id)->count();
        $totalComments = $citiesCommentsCount + $universitiesCommentsCount + $generalCommentsCount;
        
        // Toplam aldığı beğeni sayısı
        $totalLikes = CityTopic::where('user_id', $user->id)->sum('likes')
                    + UniversityTopic::where('user_id', $user->id)->sum('likes')
                    + GeneralTopic::where('user_id', $user->id)->sum('likes');
        
        // Toplam dislike sayısı
        $totalDislikes = CityTopic::where('user_id', $user->id)->sum('dislikes')
                    + UniversityTopic::where('user_id', $user->id)->sum('dislikes')
                    + GeneralTopic::where('user_id', $user->id)->sum('dislikes');
        
        // İLK 10 YORUM (Pagination için)
        $recentCitiesComments = CityTopic::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();
        
        $recentUniversitiesComments = UniversityTopic::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();
        
        $recentGeneralComments = GeneralTopic::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // BEĞENDİKLERİM - İLK 10
    $likedGeneralTopics = GeneralTopicsLike::where('user_id', $user->id)
            ->where('like', 1)
            ->with('topic')
            ->latest()
            ->take(10)
            ->get()
            ->pluck('topic')
            ->filter();
        
        $likedUniversityTopics = UniversityTopicsLike::where('user_id', $user->id)
            ->where('like', 1)
            ->with('topic')
            ->latest()
            ->take(10)
            ->get()
            ->pluck('topic')
            ->filter();
        
        $likedCityTopics = CityTopicsLike::where('user_id', $user->id)
            ->where('like', 1)
            ->with('topic')
            ->latest()
            ->take(10)
            ->get()
            ->pluck('topic')
            ->filter();

        $likedGeneralCount = GeneralTopicsLike::where('user_id', $user->id)->where('like', 1)->count();
        $likedUniversityCount = UniversityTopicsLike::where('user_id', $user->id)->where('like', 1)->count();
        $likedCityCount = CityTopicsLike::where('user_id', $user->id)->where('like', 1)->count();
        
        return view('user.profile', compact(
            'user',
            'totalComments',
            'citiesCommentsCount',
            'universitiesCommentsCount',
            'generalCommentsCount',
            'totalLikes',
            'totalDislikes',
            'recentCitiesComments',
            'recentUniversitiesComments',
            'recentGeneralComments',
            'likedGeneralTopics',
            'likedUniversityTopics',
            'likedCityTopics',
            'likedGeneralCount',
            'likedUniversityCount',
            'likedCityCount'
        ));
    }

    public function loadMoreComments(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $type = $request->type; // 'general', 'university', 'city'
        $offset = $request->offset ?? 0;
        
        $topics = collect();
        
        switch ($type) {
            case 'university':
                $topics = UniversityTopic::where('user_id', $user->id)
                    ->latest()
                    ->skip($offset)
                    ->take(10)
                    ->get();
                break;
            case 'city':
                $topics = CityTopic::where('user_id', $user->id)
                    ->latest()
                    ->skip($offset)
                    ->take(10)
                    ->get();
                break;
            default: // general
                $topics = GeneralTopic::where('user_id', $user->id)
                    ->latest()
                    ->skip($offset)
                    ->take(10)
                    ->get();
                break;
        }
        
        $html = '';
        foreach ($topics as $topic) {
            $routeName = $type === 'university' ? 'university.topic.comments' : 
                        ($type === 'city' ? 'city.topic.comments' : 'topic.comments');
            $html .= view('components.topic-box', [
                'topic' => $topic,
                'routeName' => $routeName,
                'type' => $type
            ])->render();
        }
        
        return response()->json([
            'html' => $html,
            'hasMore' => $topics->count() === 10
        ]);
    }

    public function loadMoreLiked(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $offset = $request->offset ?? 0;
        
        // Her kategoriden offset/3 kadar al (dengeli dağılım)
        $perCategory = ceil($offset / 3);
        
        // University
        $universityLiked = UniversityTopicsLike::where('user_id', $user->id)
            ->where('like', 1)
            ->with('topic')
            ->latest()
            ->skip($perCategory)
            ->take(4)
            ->get()
            ->filter(fn($like) => $like->topic)
            ->map(function($like) {
                return [
                    'topic' => $like->topic,
                    'type' => 'university',
                    'created_at' => $like->created_at
                ];
            });
        
        // General
        $generalLiked = GeneralTopicsLike::where('user_id', $user->id)
            ->where('like', 1)
            ->with('topic')
            ->latest()
            ->skip($perCategory)
            ->take(4)
            ->get()
            ->filter(fn($like) => $like->topic)
            ->map(function($like) {
                return [
                    'topic' => $like->topic,
                    'type' => 'general',
                    'created_at' => $like->created_at
                ];
            });
        
        // City
        $cityLiked = CityTopicsLike::where('user_id', $user->id)
            ->where('like', 1)
            ->with('topic')
            ->latest()
            ->skip($perCategory)
            ->take(4)
            ->get()
            ->filter(fn($like) => $like->topic)
            ->map(function($like) {
                return [
                    'topic' => $like->topic,
                    'type' => 'city',
                    'created_at' => $like->created_at
                ];
            });
        
        $html = '';
        
        // Her kategoriden ayrı ayrı ekle (kategori başlıkları ile)
        if ($universityLiked->count() > 0) {
            $html .= '<div class="liked-category-title"><i class="fa-solid fa-graduation-cap me-2"></i>Üniversiteler</div>';
            foreach ($universityLiked as $item) {
                $html .= '<div class="liked-item" data-topic-id="' . $item['topic']->id . '" data-topic-type="university">';
                $html .= view('components.topic-box', [
                    'topic' => $item['topic'],
                    'routeName' => 'university.topic.comments',
                    'type' => 'university'
                ])->render();
                $html .= '</div>';
            }
        }
        
        if ($generalLiked->count() > 0) {
            $html .= '<div class="liked-category-title"><i class="fa-solid fa-comments me-2"></i>Genel Forum</div>';
            foreach ($generalLiked as $item) {
                $html .= '<div class="liked-item" data-topic-id="' . $item['topic']->id . '" data-topic-type="general">';
                $html .= view('components.topic-box', [
                    'topic' => $item['topic'],
                    'routeName' => 'topic.comments',
                    'type' => 'general'
                ])->render();
                $html .= '</div>';
            }
        }
        
        if ($cityLiked->count() > 0) {
            $html .= '<div class="liked-category-title"><i class="fa-solid fa-city me-2"></i>Şehirler</div>';
            foreach ($cityLiked as $item) {
                $html .= '<div class="liked-item" data-topic-id="' . $item['topic']->id . '" data-topic-type="city">';
                $html .= view('components.topic-box', [
                    'topic' => $item['topic'],
                    'routeName' => 'city.topic.comments',
                    'type' => 'city'
                ])->render();
                $html .= '</div>';
            }
        }
        
        $totalLoaded = $universityLiked->count() + $generalLiked->count() + $cityLiked->count();
        
        return response()->json([
            'html' => $html,
            'hasMore' => $totalLoaded >= 10 
        ]);
    }

    public function loadMoreLikedByCategory(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $category = $request->category; 
        $offset = $request->offset ?? 0;
        
        $liked = collect();
        
        switch ($category) {
            case 'university':
                $liked = UniversityTopicsLike::where('user_id', $user->id)
                    ->where('like', 1)
                    ->with('topic')
                    ->latest()
                    ->skip($offset)
                    ->take(10)
                    ->get()
                    ->filter(fn($like) => $like->topic)
                    ->pluck('topic');
                $routeName = 'university.topic.comments';
                break;
                
            case 'general':
                $liked = GeneralTopicsLike::where('user_id', $user->id)
                    ->where('like', 1)
                    ->with('topic')
                    ->latest()
                    ->skip($offset)
                    ->take(10)
                    ->get()
                    ->filter(fn($like) => $like->topic)
                    ->pluck('topic');
                $routeName = 'topic.comments';
                break;
                
            case 'city':
                $liked = CityTopicsLike::where('user_id', $user->id)
                    ->where('like', 1)
                    ->with('topic')
                    ->latest()
                    ->skip($offset)
                    ->take(10)
                    ->get()
                    ->filter(fn($like) => $like->topic)
                    ->pluck('topic');
                $routeName = 'city.topic.comments';
                break;
        }
        
        $html = '';
        foreach ($liked as $topic) {
            $html .= '<div class="liked-item" data-topic-id="' . $topic->id . '" data-topic-type="' . $category . '">';
            $html .= view('components.topic-box', [
                'topic' => $topic,
                'routeName' => $routeName,
                'type' => $category
            ])->render();
            $html .= '</div>';
        }
        
        return response()->json([
            'html' => $html,
            'hasMore' => $liked->count() === 10
        ]);
    }

}
