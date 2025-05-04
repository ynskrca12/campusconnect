<?php

namespace App\Http\Controllers;

use App\Mail\IncomingSupportMail;
use App\Models\GeneralTopic;
use App\Models\Support;
use App\Models\Blog;
use App\Models\UniversityTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class PageController extends Controller
{
    public function home(){
        $mostLikedTopicUniversity = UniversityTopic::where('likes','>',0)
        ->orderByDesc('likes')->first();

        $mostLikedTopicGeneral = GeneralTopic::where('likes','>',0)
        ->orderByDesc('likes')->first();

        return view('home',compact('mostLikedTopicUniversity','mostLikedTopicGeneral'));
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
        return view('blog.blog',compact('blogs','blog'));
    }//End
}
