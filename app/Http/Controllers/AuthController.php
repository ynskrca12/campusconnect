<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(){
        $universiteler = DB::table('universiteler')->get();
        return view("auth.register",compact('universiteler'));
    }

    public function registerPost(Request $request)
    {
        try {
            // validation form datas
            $validatedData = $request->validate([
                'username'      => 'required|string|max:255|unique:users,username',
                'name'          => 'nullable|string|max:255',
                'email'         => 'required|email|max:255|unique:users,email',
                'university'    => 'nullable|string|max:255',
                'password'      => 'required|string|min:6|confirmed'
            ],[
                 // error messages
                'username.required'      => 'Kullanıcı adı zorunludur.',
                'username.unique'        => 'Bu kullanıcı adı zaten alınmış.',
                'email.required'         => 'Email adresi zorunludur.',
                'email.email'            => 'Geçerli bir email adresi giriniz.',
                'email.unique'           => 'Bu email adresi zaten kayıtlı.',
                'password.required'      => 'Şifre zorunludur.',
                'password.min'           => 'Şifre en az 8 karakter olmalıdır.',
                'password.confirmed'     => 'Şifreler eşleşmiyor.',
            ]);

            $user = new User();

            $user->username   = $validatedData['username'];
            $user->name       = $validatedData['name'] ?? null;
            $user->email      = $validatedData['email'];
            $user->university = $validatedData['university'];
            $user->password   = Hash::make($validatedData['password']);
           
            $user->save();

            // Notify and redirect user if registration is successful
            return redirect()
                ->route('login')
                ->with('success', 'Kayıt işlemi başarılı! Giriş yapabilirsiniz.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // validations errors
            return redirect()->back()
                            ->withErrors($e->errors())
                         ->withInput();
        }catch (\Exception $e) {
            
            Log::error('Kayıt işlemi sırasında hata oluştu: ' . $e->getMessage());
    
            return redirect()->back()
                             ->with('error', 'Kayıt işlemi sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.')
                             ->withInput();
        }     
    }//End

    public function login(){
        return view("auth.login");
    }//End
    
    public function loginPost(Request $request){
        try {
            // validation form
            $request->validate([
                'username_email' => 'required|string',
                'password'       => 'required|string|min:6',
            ], [
                'username_email.required' => 'Kullanıcı adı ya da e-posta adresi gereklidir.',
                'password.required'       => 'Şifre gereklidir.',
                'password.min'            => 'Şifre en az 6 karakter olmalıdır.',
            ]);
    
            // username or email control
            $credentials = ['password' => $request->password];
    
            if (filter_var($request->username_email, FILTER_VALIDATE_EMAIL)) {
                // if given value is email
                $credentials['email'] = $request->username_email;
            } else {
                // if given value is not email , check with username
                $credentials['username'] = $request->username_email;
            }
    
           
            if (Auth::attempt($credentials, $request->remember)) {
                return redirect()->route('home')->with('info', 'Başarıyla giriş yaptınız.');
            }
    
            // if login fails
            return back()->withInput()->withErrors([
                'username_email' => 'Geçersiz kullanıcı adı, e-posta adresi ya da şifre.',
            ]);
        } catch (ValidationException $e) {
            // validation errors
            Log::error('Login validation error: ' . implode(', ', $e->errors()));
    
            return back()->withInput()->withErrors([
                'username_email' => 'Lütfen tüm alanları doğru doldurduğunuzdan emin olun.',
            ]);
        } catch (\Exception $e) {
            // errors
            Log::error('Login error: ' . $e->getMessage());
    
            return back()->withInput()->with('error', 'Beklenmedik bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }//End
    
    public function logout(Request $request){
        try {
            // logout the user
            Auth::logout();
    
            // clearing session information because the user's session has expired
            $request->session()->invalidate();
    
            // Make the session restart
            $request->session()->regenerateToken();
    
            return redirect()->route('login')->with('success', 'Başarıyla çıkış yaptınız.');
        } catch (\Exception $e) {
            // logging and feedback to the user in case of errors
            Log::error('Çıkış yaparken hata oluştu: ' . $e->getMessage());
            
            // if the logout process fails, return the user with an appropriate message
            return redirect()->route('home')->with('error', 'Çıkış yaparken bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }//End
        

}
