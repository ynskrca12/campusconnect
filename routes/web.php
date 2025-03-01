<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\DuyuruController;
use App\Http\Controllers\IlanController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PageController;


Route::get('/testmail',[AuthController::class, 'test'])->name('testmail');
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/registerPost',[AuthController::class, 'registerPost'])->name('registerPost');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

Route::get('/login',[AuthController::class, 'login'])->name('login');
 Route::post('/login',[AuthController::class, 'loginPost'])->name('loginPost');

Route::get('/logout',[AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/universiteler',[UniversityController::class, 'index']);
Route::get('/universities/fetch', [UniversityController::class, 'fetchUniversities'])->name('universities.fetch');

Route::get('/sehirler',[CityController::class, 'index']);
Route::get('/cities/fetch', [CityController::class, 'fetchCities'])->name('universities.fetch');

Route::get('/universite_detay/{id}', [UniversityController::class, 'universite_detay'])->name('universite_detay');

Route::get('/duyurular',[DuyuruController::class,'index']);

Route::get('/ilanlar',[IlanController::class,'index'])->name('ilanlar');
Route::get('ilan_ekle',[IlanController::class,'ilan_ekle'])->name('ilan_ekle');
Route::post('ilan_ekle_post',[IlanController::class,'ilan_ekle_post'])->name('ilan_ekle_post');

Route::get('/forum',[ForumController::class,'index'])->name('forum');

Route::post('/universite/{id}/yorumlar',[StoreCommentController::class,'universite_yorum_ekle'])->name('universite_yorum_ekle');
Route::delete('/universite/{id}/yorumlar/{comment}',[DeleteCommentController::class,'universite_yorum_sil'])->name('universite_yorum_sil');

Route::get('devlet_universite_getir',[UniversityController::class,'devlet_universite_getir'])->name('devlet_universite_getir');
Route::get('vakif_universite_getir',[UniversityController::class,'vakif_universite_getir'])->name('vakif_universite_getir');


Route::get('kullanici_bilgileri',[UserController::class, 'kullanici_bilgileri'])->name('kullanici_bilgileri');
Route::get('kullanici_bilgileri_duzenle/{id}',[UserController::class, 'kullanici_bilgileri_duzenle'])->name('kullanici_bilgileri_duzenle');

Route::post('kullanici_bilgileri_duzenle_post',[UserController::class,'kullanici_bilgileri_duzenle_post'])->name('kullanici_bilgileri_duzenle_post');

Route::get('/forum/sehir/{slug}', [CityController::class, 'show'])->name('city.show');
Route::get('/get-city-category-topics',[CityController::class,'getCityCategoryTopics']);
Route::get('/get-city-category-topic-content',[CityController::class,'getCityCategoryTopicContent']);
Route::post('/city-topic/add', [CityController::class, 'addCityTopic']);


Route::get('/forum/universite/{slug}', [UniversityController::class, 'show'])->name('university.show');
Route::get('/forum/universite/mevzu/{slug}',[UniversityController::class,'topicComments'])->name('university.topic.comments');
Route::get('/get-univercity-category-topics',[UniversityController::class,'getUnivercityCategoryTopics']);
Route::get('/get-univercity-category-topic-content',[UniversityController::class,'getUnivercityCategoryTopicContent']);
Route::post('/university-topic/add', [UniversityController::class, 'addUniversityTopic']);
Route::post('/add/university/topic/comment', [UniversityController::class, 'storeComment'])->name('add.university.topic.comment');

//like dislikes for university topic
Route::post('/university/topic/{id}/like', [UniversityController::class, 'like'])->name('topics.like');
Route::post('/university/topic/{id}/dislike', [UniversityController::class, 'dislike'])->name('topics.dislike');

//create new topic in general form page
Route::post('/crete-new-topic-general-forum',[ForumController::class,'createTopicGeneralForum'])->name('create.topic.general.forum');

//random topics
Route::get('/topics/random', [ForumController::class, 'getRandomTopics'])->name('topics.random');

Route::get('/forum/mevzu/{slug}',[ForumController::class,'topicComments'])->name('topic.comments');
Route::post('/add/general/topic/comment', [ForumController::class, 'storeComment'])->name('add.general.topic.comment');

//like dislikes
Route::post('/general/topic/{id}/like', [ForumController::class, 'like'])->name('topics.like');
Route::post('/general/topic/{id}/dislike', [ForumController::class, 'dislike'])->name('topics.dislike');


Route::fallback(function () {
    return view('errors.404');
});


Route::get('/bize-ulasin',[PageController::class, 'contact_us'])->name('contact.us');
Route::post('/contact-submit',[PageController::class, 'contact_submit'])->name('contact.submit');