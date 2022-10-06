<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('login.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|min:6|max:50'
        ]);

        $validateData['picture'] = 'default.jpg';
        $validateData['role'] = 'user';
        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);
        return redirect('/login')->with('success', 'Registration sucessfully! Please Login');
    }
}
