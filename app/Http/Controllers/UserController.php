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

class UserController extends Controller
{
    public function kullanici_bilgileri(){
        if (Auth::check()) {
            $user = Auth::user();
            $universities = University::all();
            
            return view("user.kullanici_bilgileri", compact('user','universities'));
        } else {
            return redirect('/login')->with('message', 'Lütfen giriş yapınız.');
        }
    }

    public function kullanici_bilgileri_duzenle($id){
        $user = User::find($id);

        return view('user.kullanici_bilgileri_duzenle',compact('user'));
    }

    public function kullanici_bilgileri_duzenle_post(Request $request){
        $updatedData = [
            'username'   => $request->input('kullanici_adi'),
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'university' => $request->input('universite'),
        ];

        $update= User::where('id',$request->id)->update($updatedData);

        if ($update) {
            Session::flash('success','Bilgiler başarıyla güncellendi.');
            return redirect()->route('kullanici_bilgileri');
        } else {
            Session::flash('error','Bilgiler güncellenemedi!');
            return back();
        }
    }

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

        return redirect()->route('kullanici_bilgileri')->with('success', 'E-posta adresiniz başarıyla güncellenmiştir.');
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
                
            $liked_topics = $cities_topics_likes->merge($universities_topics_likes)
            ->merge($general_topics_likes)
            ->sortByDesc(fn($topic) => $topic->topic->created_at);

        return view('user.my_likes',compact('liked_topics','user'));
    }//End

    public function my_comments(){
        $user = Auth::user();

        $my_cities_comments = CityTopic::where('user_id', $user->id)->get();

        $my_universities_comments = UniversityTopic::where('user_id', $user->id)->get();

        $my_general_comments = GeneralTopic::where('user_id', $user->id)->get();
    
        $my_comments = $my_cities_comments->merge($my_universities_comments)
        ->merge($my_general_comments)
        ->sortByDesc(fn($topic) => $topic->created_at);

        return view('user.my_comments',compact('user','my_comments'));
    }//End
}
