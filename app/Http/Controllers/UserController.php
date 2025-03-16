<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Mail\EmailUpdatedNotification;
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
    
}
