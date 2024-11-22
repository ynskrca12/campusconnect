<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(){
        $universiteler = DB::table('universiteler')->get();
        return view("auth.register",compact('universiteler'));
    }

    public function registerPost(Request $request)
    {
        // Form verisi doğrulama
        $validator = Validator::make($request->all(), [
            'kullanici_adi' => 'required|string|max:255|unique:users,kullanici_adi',
            'ad_soyad' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'university' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed', // 'password_confirmation' otomatik olarak kontrol edilir
        ]);

        // Eğer doğrulama hatası varsa, hata mesajlarını geri gönder
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Veritabanına yeni kullanıcı kaydetme
        $user = User::create([
            'kullanici_adi' => $request->input('kullanici_adi'),
            'ad_soyad' => $request->input('ad_soyad'),
            'email' => $request->input('email'),
            'university' => $request->input('university'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Kayıt işlemi başarılı olursa kullanıcıyı giriş yapabilir duruma getirme veya yönlendirme
        return redirect()->route('login')->with('success', 'Kayıt başarılı!');
    }//End

    public function login(){
        
        // $publicPath = public_path();
        // $folders = File::directories($publicPath);
        //  print_r($folders);die;
        return view("auth.login");
    }

    public function loginPost(Request $request)
    {
        // Kullanıcı adı ya da e-posta ile giriş yapmak için gelen veriyi alıyoruz
        $credentials = [
            "password" => $request->password,
        ];
    
        // Kullanıcı adı veya e-posta kontrolü
        if (filter_var($request->username_email, FILTER_VALIDATE_EMAIL)) {
            // Eğer verilen değer bir e-posta ise
            $credentials['email'] = $request->username_email;
        } else {
            // Eğer verilen değer bir e-posta değilse, o zaman kullanıcı adı olarak kabul et
            $credentials['kullanici_adi'] = $request->username_email;
        }
    
        // Kullanıcı adı ya da e-posta ile giriş yapmaya çalışıyoruz
        if (Auth::attempt($credentials)) {
            return redirect('/')->with("info", "Giriş Yaptınız.");
        }
    
        // Eğer giriş başarılı olmazsa, hata mesajını geri gönderiyoruz
        return back()->with("error", "Email veya Şifre Hatalı.");
    }//End
    

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with("success","Başarıyla Çıkış Yaptınız.");
    }//End

    public function verifyEmail($token){
        $user = User::where('email_verified_token', $token)->firstOrFail();
        
        $user->email_verified_at = now();
        $user->email_verified_token = null; // Token'ı sıfırla
        $user->save();
    
        return redirect('/login')->with('success', 'E-posta adresiniz doğrulandı. Şimdi giriş yapabilirsiniz.');
    }//End
    

}
