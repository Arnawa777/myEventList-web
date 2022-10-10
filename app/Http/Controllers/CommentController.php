<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'body' => 'required|min:2',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['post_id'] = $request->input('post_id');

        // dd($validatedData);
        Comment::create($validatedData);
        //Unfinish - Blom ada output buat nampilin text
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!!!');
    }

    public function destroy(Request $request)
    {

        // dd($request->comment_id);
        Comment::destroy($request->comment_id);
        // Comment::destroy($comment->id);
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!!!');
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        // dd($validatedData);
        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['comment_id'] = $request->comment_id;

        // dd($request->comment_id);

        Comment::where('id', $request->comment_id)
            ->where('user_id', auth()->user()->id)
            ->update($validatedData);

        return redirect()->back()->with('success', 'Komentar berhasil diubah!!!');
    }
}
