<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
        $this->validate($request, [
            'event_id' => 'required',
        ]);
        $itemuser = $request->user();
        $validasiwishlist = Favorite::where('event_id', $request->event_id)
                                    ->where('user_id', $itemuser->id)
                                    ->first();
        if ($validasiwishlist) {
            $validasiwishlist->delete();//kalo udah ada, berarti wishlist dihapus
            return back()->with('success', 'Wishlist berhasil dihapus');
        } else {
            $inputan = $request->all();
            $inputan['user_id'] = $itemuser->id;
            Favorite::create($inputan);
            return back()->with('success', 'Produk berhasil ditambahkan ke wishlist');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $favorites = Favorite::where('user_id', $user->id)
        ->paginate(10);

        return view('users.favorite', [
        "title" => "Favorite",
        "user" => $user,
        'favorites' => $favorites,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($favorite->id);
        Favorite::where('id', $id)
        ->delete();

        // $favorite->delete();
        // Favorite::destroy($id);
        
        // Favorite::where('id', $favorite->id)
        // ->destroy('id');

        return back()->with('success', 'Favorite has been delete!!!');

        // $favorites = Favorite::findOrFail($favorite->id);
        // if ($favorites->delete()) {
        //     return back()->with('success', 'Wishlist berhasil dihapus');
        // } else {
        //     return back()->with('error', 'Wishlist gagal dihapus');
        // }
    }
}
