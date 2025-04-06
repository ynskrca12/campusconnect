<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\resetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Exception;

class AuthController extends Controller
{
    public function register(){
        $universiteler = DB::table('universiteler')->get();
        return view("auth.register",compact('universiteler'));
    }

    public function registerPost(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username'      => 'required|string|max:255|unique:users,username',
                'name'          => 'nullable|string|max:255',
                'gender'        => 'required|string|max:255',
                'email'         => 'required|email|max:255|unique:users,email',
                'university'    => 'nullable|string|max:255',
                'password'      => 'required|string|min:6|confirmed'
            ], [
                'username.required'      => 'Kullanıcı adı zorunludur.',
                'username.unique'        => 'Bu kullanıcı adı zaten alınmış.',
                'email.required'         => 'Email adresi zorunludur.',
                'email.email'            => 'Geçerli bir email adresi giriniz.',
                'email.unique'           => 'Bu email adresi zaten kayıtlı.',
                'password.required'      => 'Şifre zorunludur.',
                'password.min'           => 'Şifre en az 8 karakter olmalıdır.',
                'password.confirmed'     => 'Şifreler eşleşmiyor.',
            ]);
    
            $defaultImages = [
                'male'   => 'man.png',
                'female' => 'woman.png',
                'pass'   => 'pass_gender.png'
            ];

            $user = new User();
    
            $user->username   = $validatedData['username'];
            $user->name       = $validatedData['name'] ?? null;
            $user->email      = $validatedData['email'];
            $user->gender     = $validatedData['gender'];
            $user->university = $validatedData['university'];
            $user->password   = Hash::make($validatedData['password']);
            $user->user_image = $defaultImages[$validatedData['gender']];

            $user->save();

            Mail::to($user->email)->send(new VerifyEmail($user));
    
            return redirect()
                ->route('login')
                ->with('success', 'Kayıt işlemi başarılı! Mail adresinizi kontrol ediniz.');
        } catch (\Illuminate\Validation\ValidationException $e) {
           
            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput();
        } catch (\Exception $e) {
            Log::error('Kayıt işlemi sırasında hata oluştu: ' . $e->getMessage());
            // General error
            return redirect()->back()
                            ->with('error', 'Kayıt işlemi sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.')
                            ->withInput();
        }
    }//End

    public function verifyEmail($id, $hash)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Kullanıcı bulunamadı.');
        }

        if (sha1($user->email) === $hash) {
            $user->markEmailAsVerified(); 
            return redirect()->route('login')->with('success', 'E-posta başarıyla doğrulandı!');
        }

        return redirect()->route('login')->with('error', 'E-posta doğrulama başarısız.');
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
                'password.required'       => 'şifre girsene dostum.',
                'password.min'            => 'Şifre en az 6 karakter olmalıdır.',
            ]);
    
            // username or email control
            $credentials = ['password' => $request->password];
    
            if (filter_var($request->username_email, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $request->username_email;
            } else {
                $credentials['username'] = $request->username_email;
            }

            $user = User::where(function ($query) use ($request) {
                    $query->where('email', $request->username_email)
                        ->orWhere('username', $request->username_email);
                })->first();

            if (!$user) {
                return back()->withInput()->with('error', 'Geçersiz kullanıcı adı, e-posta adresi ya da şifre.');
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->withInput()->with('error', 'Geçersiz kullanıcı adı, e-posta adresi ya da şifre.');
            }
    
            if (is_null($user->email_verified_at)) {
                return back()->withInput()->with('error', 'E-posta adresiniz doğrulanmamış. Lütfen e-postanızı kontrol edin.');
            }
    
           
            if (Auth::attempt($credentials, $request->remember)) {
                return redirect()->route('home')->with('success', 'Başarıyla giriş yaptınız.');
            }
    
            // if login fails
            return back()->withInput()->with('error', 'Geçersiz kullanıcı adı, e-posta adresi ya da şifre.');
        } catch (ValidationException $e) {
            Log::error('Login validation error: ' . json_encode($e->errors())); 
            return back()->withInput()->withErrors($e->validator->errors());
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

    public function sendResetMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen geçerli bir e-posta adresi girin.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            
            $user = User::where('email', $request->email)->firstOrFail();
            $token = Password::createToken($user);

            Mail::to($user->email)->send(new resetPasswordMail($user, $token));

            return response()->json([
                'success' => true,
                'message' => 'Şifre sıfırlama bağlantısı e-posta adresinize gönderildi.'
            ], 200);
        } catch (Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Şifre sıfırlama e-postası gönderilirken bir hata oluştu. Lütfen tekrar deneyin.',
                'error' => $e->getMessage()
            ], 500);
        }
    }//End
    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');
    
        return view('auth.reset_password_form', compact('token', 'email'));
    }//End
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('success', 'Şifreniz başarıyla sıfırlandı. Lütfen giriş yapınız.');
            }

            return back()->withErrors(['email' => 'Geçersiz token veya e-posta adresi.']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Bir hata oluştu. Lütfen tekrar deneyin.']);
        }
    }//End

}
