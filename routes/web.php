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

Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

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
    Route::get('/setting', [UserController::class, 'user_setting']);
    Route::post('/setting', [UserController::class, 'update_avatar']);
    
    //Dashboard
    Route::get('/dashboard', function(){
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

Route::group(['middleware' => 'role:admin'], function () {

});

Route::group(['middleware' => 'role:user'], function () {
    
});





Route::get('/posts', [PostController::class, 'index']);
//Halaman Single Post
//Use route model binding
Route::get('posts/{post:slug}', [PostController::class, 'show']);







Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user:username}', [UserController::class, 'show']);

Route::get('/topics', [TopicController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{event:slug}', [EventController::class, 'show']);

Route::get('/people', [PersonController::class, 'index']);
Route::get('/person/{person:slug}', [PersonController::class, 'show']);

Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/character/{character:slug}', [CharacterController::class, 'show']);

