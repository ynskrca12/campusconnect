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

    public function my_likes(){
            $user = Auth::user();

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

            $liked_topics = $cities_topics_likes
                ->merge($universities_topics_likes)
                ->merge($general_topics_likes)
                ->sortByDesc(fn($topic) => $topic->topic->created_at);


        return view('user.my_likes',compact('liked_topics','user'));
    }//End

    public function my_comments(){
        $user = Auth::user();

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

        // Önce array'e dönüştürüp merge et, sonra koleksiyona dönüştür
        $mergedArray = array_merge(
            $my_cities_comments->all(),
            $my_universities_comments->all(),
            $my_general_comments->all()
        );

        $my_comments = collect($mergedArray)
            ->sortByDesc(fn($topic) => $topic->created_at)
            ->values();

        return view('user.my_comments',compact('user','my_comments'));
    }//End

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

}
