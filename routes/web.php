<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Dashboard\DashboardEventController;
use App\Http\Controllers\Dashboard\DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardActorEventController;
use App\Http\Controllers\Dashboard\DashboardWorkerController;
use App\Http\Controllers\Dashboard\DashboardPostController;
use App\Http\Controllers\Dashboard\DashboardTopicController;
use App\Http\Controllers\Dashboard\DashboardPersonController;
use App\Http\Controllers\Dashboard\DashboardActorController;
use App\Http\Controllers\Dashboard\DashboardCharacterController;
use App\Http\Controllers\Dashboard\DashboardLocationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Arnawa Juan Ibnuaji",
        "email" => "kurohaku12@gmail.com",
        "image" => "kuro.jpg"
    ]);
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store'])->name('user.store');
    //add more Routes here
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/setting/picture', [UserController::class, 'avatar_setting']);
    Route::put('/setting/picture', [UserController::class, 'avatar_update']);
    Route::delete('/setting/picture', [UserController::class, 'avatar_reset']);
    Route::get('/setting/profile', [UserController::class, 'profile_setting']);
    Route::put('/setting/profile', [UserController::class, 'profile_update']);

    //Manage Review
    Route::resource('/events/{event:slug}/review', ReviewController::class);

    //Create post forum
    Route::get('/forum/{topic:slug}/create-post', [ForumController::class, 'create']);
    Route::post('/forum/{topic:slug}', [ForumController::class, 'store']);


    //Comments
    Route::resource('/forum/{topic:sub_topic}/{post:slug}/comment', CommentController::class);

    //Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.home', [
            "title" => "Dashboard"
        ]);
    });
    Route::resource('/dashboard/events', DashboardEventController::class);
    Route::resource('/dashboard/categories', DashboardCategoryController::class);
    //Parameter untuk mengganti default parameter
    Route::resource('/dashboard/staff', DashboardWorkerController::class)->parameters([
        'staff' => 'staff' //Kiri Default Diganti ke kanann
    ]);


    Route::get('/dashboard/actor-events/search', [DashboardActorEventController::class, 'search']);
    Route::resource('/dashboard/actor-events', DashboardActorEventController::class);


    Route::resource('/dashboard/posts', DashboardPostController::class);
    Route::resource('/dashboard/topics', DashboardTopicController::class);

    Route::resource('/dashboard/people', DashboardPersonController::class);
    Route::resource('/dashboard/actors', DashboardActorController::class);

    Route::resource('/dashboard/characters', DashboardCharacterController::class);
    Route::resource('/dashboard/locations', DashboardLocationController::class);
    //add more Routes here



});

Route::get('/users', [PostController::class, 'index']);

Route::get('/profile/{user:username}', [UserController::class, 'profile']);
Route::get('/profile/{user:username}/favorites', [FavoriteController::class, 'show']);
// Route::delete('/profile/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
Route::resource('favorites', FavoriteController::class);

Route::group(['middleware' => 'role:admin'], function () {
});

Route::group(['middleware' => 'role:user'], function () {
});






Route::get('/forum', [ForumController::class, 'index']);
Route::get('/forum/{topic:slug}', [ForumController::class, 'topic']);
Route::get('/forum/{topic:slug}/{post:slug}', [ForumController::class, 'post'])->name('forum.post');
//Halaman Single Post
//Use route model binding
Route::get('posts/{post:slug}', [PostController::class, 'show']);




Route::resource('/events', EventController::class);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user:username}', [UserController::class, 'show']);

Route::get('/topics', [TopicController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);


Route::get('/people', [PersonController::class, 'index']);
Route::get('/people/{person:slug}', [PersonController::class, 'show']);

Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/characters/{character:slug}', [CharacterController::class, 'show']);

Route::post('delete-comment', [CommentController::class, 'destroy']);
