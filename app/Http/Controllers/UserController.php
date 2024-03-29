<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('users.users', [
            'title' => 'Daftar User',
            //withQueryString membawa semua query diatas ke pagination (blom kepake)
            'users' => User::latest()->filter(request(['search']))->paginate(6)->withQueryString(),
        ]);
    }

    public function profile(User $user)
    {
        $favorites = Favorite::where('user_id', $user->id)
            ->paginate(4);

        return view('users.profile', [
            'user' => $user,
            'favorites' => $favorites,
            'title' => "$user->username's Profile",
        ]);
    }

    public function avatar_setting()
    {
        return view('users.setting.picture', [
            //data user yang sedang login
            'user' => Auth::user(),
            'title' => 'Pengaturan User - Foto',

        ]);
    }

    public function avatar_update(Request $request)
    {
        $rules = [
            'picture' => 'required|image|file|max:2048',
        ];

        $validatedData = $request->validate($rules);

        if (!empty($request->oldPicture)) {
            if ($request->oldPicture !== 'default.jpg') {
                $file = public_path('/storage/user-picture/' . $request->oldPicture);

                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        $filename = time() . '-' . $request->picture->getClientOriginalName() . '.' .  $request->picture->getClientOriginalExtension();
        $request->picture->storeAs('user-picture', $filename, 'public');

        $validatedData['picture'] = $filename;

        User::where('id', Auth()->user()->id)
            ->update($validatedData);


        return redirect()->back();
    }

    public function avatar_reset()
    {
        if (Auth()->user()->picture !== 'default.jpg') {
            $file = public_path('/storage/user-picture/' . Auth()->user()->picture);

            if (file_exists($file)) {
                unlink($file);
            }
        }
        User::where('id', Auth()->user()->id)
            ->update(['picture' => 'default.jpg']);

        return redirect()->back();
    }

    public function profile_setting()
    {
        return view('users.setting.profile', [
            //data user yang sedang login
            'user' => Auth::user(),
            'title' => 'Pengaturan User - Profil',

        ]);
    }

    public function profile_update(Request $request)
    {
        $rules = [
            'name' => 'nullable|min:3|max:50',
            'email' => 'required|email|max:255|unique:users,email,' . Auth()->user()->id,
            'biography' => ''
        ];

        $validatedData = $request->validate($rules);

        User::where('id', Auth()->user()->id)
            ->update($validatedData);

        return redirect('/setting/profile');
    }

    public function user_posts(User $user, Topic $topic)
    {
        $posts = Post::where('user_id', $user->id)
            ->paginate(10);

        return view('users.posts', [
            "title" => "$user->username - Daftar Post",
            "user" => $user,
            'posts' => $posts,
            "topic" => $topic,
        ]);
    }
}
