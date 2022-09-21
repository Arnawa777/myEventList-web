<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Exception;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $validatedData['rating']  = $request->rating;
        $validatedData['body']  = $request->body;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['event_id'] = $request->input('event_id');
        // dd($validatedData);

        Review::create($validatedData);

        return redirect()->back()->with('success', 'Your review has been added!!!');
    }

    public function update(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'body' => 'nullable',
        ]);

        $validatedData['rating']  = $request->rating;
        // dd($validatedData);
        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['review_id'] = $request->review_id;
        // $validatedData['event_id'] = $request->event_id;

        // dd($request->comment_id);

        Review::where('id', $request->review_id)
            ->where('user_id', auth()->user()->id)
            ->where('event_id', $request->event_id)
            ->update($validatedData);

        return redirect()->back()->with('success', 'Review has been update!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $route = Route::current();
        // dd($route);
        // dd($request);
        Review::destroy($request->my_review_id);
        // Review::destroy($review->id);
        return redirect()->back()->with('success', 'Your Review has been delete!!!');
    }
}
