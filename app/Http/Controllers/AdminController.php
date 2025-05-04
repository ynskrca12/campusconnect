<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CityTopic;
use App\Models\GeneralTopic;
use App\Models\Support;
use App\Models\UniversityTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;


class AdminController extends Controller
{
    public function index(){
        $totalUsers = User::where('user_type',1)->count();
        $totalGeneralForum = GeneralTopic::count();
        $totalUniversityForum = UniversityTopic::count();
        $totalCityForum = CityTopic::count();

        $totalForum = $totalGeneralForum + $totalUniversityForum + $totalCityForum;
        //blog-makale sayısı
        $totalBlog = Blog::count();

        $totalSupport = Support::count();

        return view('admin.dashboard',compact('totalUsers','totalGeneralForum','totalUniversityForum','totalCityForum','totalSupport','totalForum','totalBlog'));
    }//End

    public function adminLogin(){
        return view('admin.login');
    }//End

    public function adminLoginPost(Request $request){
        $credentials = ['password' => $request->password];
    
        if (filter_var($request->admin_email, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->admin_email;
        }

        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type == 0) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Yalnızca adminler giriş yapabilir.');
            }
        }

        return redirect()->back()->with('error', 'Email veya şifre hatalı.');
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

    public function blogs(){
        $blogs = Blog::latest()->get();
        return view('admin.blog.blogs',compact('blogs'));
    }//End

    public function blogCreate(){
        $blogCategories = BlogCategory::all();
        return view('admin.blog.create',compact('blogCategories'));
    }//End

    public function blogStore(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'category'        => 'required|integer|exists:blog_categories,id',
            'blog_content'    => 'required',
            'blog_summary'    => 'required|string',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'meta_keywords'   => 'nullable|string|max:255',
            'cover_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        // dd($validated);

        try {
            DB::beginTransaction();


            // Dosya dizinlerini oluşturuyoruz
            $coverDir = public_path('blog_img/cover_img');
            $contentDir = public_path('blog_img/content_img');

            // Eğer dizin yoksa oluşturuyoruz
            if (!file_exists($coverDir)) {
                mkdir($coverDir, 0777, true);
            }

            if (!file_exists($contentDir)) {
                mkdir($contentDir, 0777, true);
            }

            // Default görsel
            $coverImageName = 'default_blog_img.webp';
            if ($request->hasFile('cover_image')) {
                $coverImageFile = $request->file('cover_image');
                $coverImageName = uniqid() . '_cover.' . $coverImageFile->getClientOriginalExtension();
                // Dosyayı public/blog_img/cover_img dizinine kaydediyoruz
                $coverImageFile->move($coverDir, $coverImageName);
            }

            $contentImageName = 'default_blog_img.webp';
            if ($request->hasFile('content_image')) {
                $contentImageFile = $request->file('content_image');
                $contentImageName = uniqid() . '_content.' . $contentImageFile->getClientOriginalExtension();
                // Dosyayı public/blog_img/content_img dizinine kaydediyoruz
                $contentImageFile->move($contentDir, $contentImageName);
            }

            
            

            $currentDate = strtolower(now()->format('dMY')); 
            $randomCode = strtolower(Str::random(5)); 
            $slug = Str::slug($request->input('title')) . '-' . $currentDate . '-' . $randomCode;


            $blog = new Blog();
            $blog->user_id         = auth()->id();
            $blog->title           = $request->title;
            $blog->slug            = $slug;
            $blog->category_id     = $request->category;
            $blog->summary         = $request->blog_summary;
            $blog->content         = $request->blog_content;
            $blog->cover_image     = 'blog_img/cover_img/' . $coverImageName;
            $blog->content_image   = 'blog_img/content_img/' . $contentImageName;
            $blog->seo_title       = $request->seo_title;
            $blog->seo_description = $request->seo_description;
            $blog->meta_keywords   = $request->meta_keywords;
            $blog->view_count      = 0;
            $blog->likes           = 0;
            $blog->dislikes        = 0;
            $blog->save();
            // dd($blog);
            DB::commit();

            return redirect()->route('admin.blogs')->with('success', 'Blog başarıyla oluşturuldu.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Blog kayıt hatası: ' . $e->getMessage(), [
                'request_data' => $request->all()
            ]);
            return redirect()->back()->withInput()->with('error', 'Bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }

    public function blogCategories(){
        $blogCategories = BlogCategory::all();
        return view('admin.blog.categories',compact('blogCategories'));
    }//End

    public function blogCategoryCreate(){
        return view('admin.blog.category_create');
    }//End

    public function blogCategoryStore(Request $request){
        $request->validate([
            'category_name' => 'required',
            'category_slug' => 'required',
        ]);
        $blogCategory = new BlogCategory();
        $blogCategory->name = $request->category_name;
        $blogCategory->slug = $request->category_slug;
        $blogCategory->save();

        return redirect()->back()->with('success','Blog kategorisi oluşturuldu');
        // return redirect()->route('admin.blog.categories')->with('success','Blog kategorisi oluşturuldu');
    }//End
}
