<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users.users', [
            'title' => 'Users',
            //withQueryString membawa semua query diatas ke pagination (blom kepake)
            'users' => User::latest()->paginate(7)->withQueryString()
        ]);
        
    }

    public function show(User $author)
    {
        return view('posts', [
            'title' => "Post By Author : $author->name",
            'posts' => $author->posts->load('category', 'author'),
        ]);
    }

    public function profile(User $user)
    {
        return view('users.profile', [
            'user'=> $user,
            'title' => "$user->username's Profile" ,
        ]);
    }

    public function user_setting()
    {
        return view('users.setting', [
            //data user yang sedang login
            'user'=> Auth::user(),
            'title' => 'User Setting',
    
        ]);
    }

    public function update_avatar(Request $request)
    {
        $request->validate([
            'image' => 'mimes:bmp,jpg,jpeg,png,webp|max:2048',
           ]);

        if($request->hasFile('image')){
            // memberikan nama pada file yang diupload
            $filename = time() .'-'.$request->image->getClientOriginalName().'.' .  $request->image->getClientOriginalExtension();
            // Jika nama file bukan default.jpg lakukan penghapusan gambar sebelumnya
            if (Auth()->user()->picture !== 'default.jpg') {
                $file = public_path('/storage/user-picture/' . Auth()->user()->picture);
                
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $request->image->storeAs('user-picture',$filename,'public');
            Auth()->user()->update(['picture'=>$filename]);
        }

        return redirect()->back();
    }

    public function reset_avatar()
    {
        if (Auth()->user()->picture !== 'default.jpg') {
            $file = public_path('/storage/user-picture/' . Auth()->user()->picture);
            
            if (file_exists($file)) {
                unlink($file);
            }
        }
        Auth()->user()->update(['picture'=>'default.jpg']);
    }
}
