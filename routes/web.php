<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PageController;


Route::get('/testmail',[AuthController::class, 'test'])->name('testmail');

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');


// Route::get('/', function () {
//     return view('home');
// })->name('home');

Route::get('/',[PageController::class, 'home'])->name('home');

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
    Route::get('/blog-olustur', [AdminController::class, 'blogCreate'])->name('admin.blog.create');
    Route::post('/blog-olustur', [AdminController::class, 'blogStore'])->name('admin.blog.store');
    Route::get('/blog/{id}/duzenle', [AdminController::class, 'blogEdit'])->name('admin.blog.edit');
    Route::post('/blog/{id}/duzenle', [AdminController::class, 'blogUpdate'])->name('admin.blog.update');
    Route::get('/blog/{id}/sil', [AdminController::class, 'blogDelete'])->name('admin.blog.delete');

    Route::get('/blog-categories', [AdminController::class, 'blogCategories'])->name('admin.blog.categories');
    Route::get('blog-kategori-olustur', [AdminController::class, 'blogCategoryCreate'])->name('admin.blog.category.create');
    Route::post('blog-kategori-olustur', [AdminController::class, 'blogCategoryStore'])->name('admin.blog.category.store');
    Route::get('blog-kategori/{id}/duzenle', [AdminController::class, 'blogCategoryEdit'])->name('admin.blog.category.edit');
    Route::post('blog-kategori/{id}/duzenle', [AdminController::class, 'blogCategoryUpdate'])->name('admin.blog.category.update');
    Route::get('blog-kategori/{id}/sil', [AdminController::class, 'blogCategoryDelete'])->name('admin.blog.category.delete');

    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/admin/login',[AdminController::class, 'adminLogin'])->name('admin.login');
    Route::post('/admin/login',[AdminController::class, 'adminLoginPost'])->name('admin.login.post');

    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::post('/login',[AuthController::class, 'loginPost'])->name('loginPost');

    Route::get('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/registerPost',[AuthController::class, 'registerPost'])->name('registerPost');

    Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::post('/reset-password-mail', [AuthController::class, 'sendResetMail']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/universite/{id}/yorumlar',[StoreCommentController::class,'universite_yorum_ekle'])->name('universite_yorum_ekle');
    Route::delete('/universite/{id}/yorumlar/{comment}',[DeleteCommentController::class,'universite_yorum_sil'])->name('universite_yorum_sil');

    Route::get('kullanici-bilgileri',[UserController::class, 'user_informations'])->name('user.informations');
    Route::post('/profile/image', [UserController::class, 'updateImage'])->name('profile.image.update');
    Route::get('istatistiklerim',[UserController::class, 'my_statistics'])->name('my.statistics');
    Route::get('begendiklerim',[UserController::class, 'my_likes'])->name('my.likes');
    Route::get('yorumlarim',[UserController::class, 'my_comments'])->name('my.comments');

    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('/check-username', [UserController::class, 'checkUsername'])->name('user.checkUsername');
    Route::get('/profile/check-email', [UserController::class, 'checkEmail'])->name('profile.check.email');
    Route::post('/user/profile/update-email', [UserController::class, 'updateEmail'])->name('user.profile.update.email');
    Route::get('/verify-email/{token}', [UserController::class, 'verifyEmail'])->name('user.verify.email');

    Route::post('/city-topic/add', [CityController::class, 'addCityTopic']);
    Route::post('/add/city/topic/comment', [CityController::class, 'storeComment'])->name('add.city.topic.comment');

    //like disllike for city topic
    Route::post('/city/topic/{id}/like', [CityController::class, 'like'])->name('topics.like');
    Route::post('/city/topic/{id}/dislike', [CityController::class, 'dislike'])->name('topics.dislike');

    Route::post('/university-topic/add', [UniversityController::class, 'addUniversityTopic']);
    Route::post('/add/university/topic/comment', [UniversityController::class, 'storeComment'])->name('add.university.topic.comment');

    //like dislikes for university topic
    Route::post('/university/topic/{id}/like', [UniversityController::class, 'like'])->name('topics.like');
    Route::post('/university/topic/{id}/dislike', [UniversityController::class, 'dislike'])->name('topics.dislike');

    //create new topic in general form page
    Route::post('/crete-new-topic-general-forum',[ForumController::class,'createTopicGeneralForum'])->name('create.topic.general.forum');

    Route::post('/add/general/topic/comment', [ForumController::class, 'storeComment'])->name('add.general.topic.comment');

    //like dislikes
    Route::post('/general/topic/{id}/like', [ForumController::class, 'like'])->name('topics.like');
    Route::post('/general/topic/{id}/dislike', [ForumController::class, 'dislike'])->name('topics.dislike');

    //blog comments 
    Route::post('/add/blog/comment/{id}', [PageController::class, 'storeComment'])->name('add.blog.comment');
    Route::post('/blog/comment/reply', [PageController::class, 'replyComment'])->name('add.blog.comment.reply');

    //delete topic
    Route::get('/topic-delete', [ForumController::class, 'deleteTopic'])->name('topic.delete');

});


Route::get('/universiteler',[UniversityController::class, 'index'])->name('universities');
Route::get('/universities/fetch', [UniversityController::class, 'fetchUniversities'])->name('universities.fetch');

Route::get('/sehirler',[CityController::class, 'index'])->name('cities');
Route::get('/cities/fetch', [CityController::class, 'fetchCities'])->name('universities.fetch');

Route::get('/universite_detay/{id}', [UniversityController::class, 'universite_detay'])->name('universite_detay');

Route::get('/forum',[ForumController::class,'index'])->name('forum');

Route::get('devlet_universite_getir',[UniversityController::class,'devlet_universite_getir'])->name('devlet_universite_getir');
Route::get('vakif_universite_getir',[UniversityController::class,'vakif_universite_getir'])->name('vakif_universite_getir');

Route::get('/forum/sehir/{slug}', [CityController::class, 'show'])->name('city.show');
Route::get('/forum/sehir/mevzu/{slug}',[CityController::class,'topicComments'])->name('city.topic.comments');
Route::get('/get-city-category-topics',[CityController::class,'getCityCategoryTopics']);
Route::get('/get-city-category-topic-content',[CityController::class,'getCityCategoryTopicContent']);

// Route::get('/forum/universite/{slug}', [UniversityController::class, 'show'])->name('university.show');
Route::get('/universite-yorumlari/{slug}', [UniversityController::class, 'show'])->name('university.show');
Route::get('/universite-yorumlari/konu/{slug}',[UniversityController::class,'topicComments'])->name('university.topic.comments');
// Route::get('/forum/universite/mevzu/{slug}',[UniversityController::class,'topicComments'])->name('university.topic.comments');
Route::get('/get-univercity-category-topics',[UniversityController::class,'getUnivercityCategoryTopics']);
Route::get('/get-univercity-category-topic-content',[UniversityController::class,'getUnivercityCategoryTopicContent']);

Route::get('blog-makale',[PageController::class,'blogs'])->name('blogs');
Route::get('blog-makale/{slug}',[PageController::class,'blog'])->name('blog.single');

//random topics
Route::get('/topics/random', [ForumController::class, 'getRandomTopics'])->name('topics.random');

Route::get('/forum/mevzu/{slug}',[ForumController::class,'topicComments'])->name('topic.comments');

//get blog comments
Route::get('/blog/{id}/comments', [PageController::class, 'getComments'])->name('get.blog.comments');

Route::fallback(function () {
    return view('errors.404');
});


Route::get('/bize-ulasin',[PageController::class, 'contact_us'])->name('contact.us');
Route::post('/contact-submit',[PageController::class, 'contact_submit'])->name('contact.submit');

Route::get('/hakkimizda',[PageController::class, 'about_us'])->name('about.us');
Route::get('/hizmetlerimiz',[PageController::class, 'services'])->name('services');

Route::get('/calisma-alanim', function () {
    if (auth()->check()) {
        return app(WorkspaceController::class)->my_workspace();
    }
    return view('workspace.workspace-promo');
})->name('my_workspace');


Route::post('/workspace/task', [WorkspaceController::class, 'storeTask'])->name('workspace.task.store');
Route::patch('/workspace/task/{task}/status', [WorkspaceController::class, 'updateTaskStatus'])->name('workspace.task.update.status');

// web.php
Route::patch('/workspace/task/{task}/rename', [WorkspaceController::class, 'renameTask']);
Route::delete('/workspace/task/{task}', [WorkspaceController::class, 'destroyTask']);
Route::get('/tasks/{task}', [WorkspaceController::class, 'show'])->name('tasks.show');

// (Eğer düzenleme/silme işlemleri varsa)
Route::get('/tasks/{task}/edit', [WorkspaceController::class, 'edit'])->name('tasks.edit');
Route::delete('/tasks/{task}', [WorkspaceController::class, 'destroy'])->name('tasks.destroy');

Route::post('/tasks/live-update', [WorkspaceController::class, 'liveUpdate'])->name('tasks.live.update');


Route::middleware(['auth'])->group(function () {
    Route::get('/workspace', [WorkspaceController::class, 'task_board'])->name('workspace.index');
    Route::post('/workspace/create-board', [WorkspaceController::class, 'createBoard'])->name('workspace.createBoard');
});


Route::get('/user-preview/{id}', [UserController::class, 'preview']);

// routes/web.php
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);


