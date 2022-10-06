<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Character;
use App\Models\Event;
use App\Models\Location;
use App\Models\Person;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use App\Models\Worker;


class DashboardHomeController extends Controller
{
    public function index()
    {
        return view('dashboard.home', [
            'title' => 'Dashboard',
            'actors' => Actor::count(),
            'categories' => Category::count(),
            'characters' => Character::count(),
            'events' => Event::count(),
            'locations' => Location::count(),
            'people' => Person::count(),
            'posts' => Post::count(),
            'topics' => Topic::count(),
            'users' => User::count(),
            'staff' => Worker::count(),
        ]);
    }
}
