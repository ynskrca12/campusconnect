<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function kullanici_bilgileri(){
        if (Auth::check()) {
            $user = Auth::user();
            return view("user.kullanici_bilgileri", compact('user'));
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
}
