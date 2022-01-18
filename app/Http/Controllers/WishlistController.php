<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\WishlistRequest;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->orderby('id', 'desc')->paginate(10);
        return view('wishlist', ['wishlists' => $wishlists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WishlistRequest $request)
    {
        $validated = $request->validated();

        if (Auth::user()->wishlist()->where('prodcut_id', $validated['prodcut_id'])->exists()) {
            return response()->json([
                'err' => 'Prodcut already in wishlist'
            ]);
        }

        Auth::user()->wishlist()->create($validated);

        return response()->json([
            'msg'   => 'Prodcut Added Successfully',
            'count' => Auth::user()->wishlist()->count()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $response = Gate::inspect('delete', $wishlist);

        if ($response->allowed()) {

            if (!Auth::user()->wishlist()->where('prodcut_id', $wishlist->prodcut_id)->exists()) {
                return response()->json([
                    'err' => 'Prodcut not found in wishlist'
                ]);
            }

            $wishlist->delete();

            return response()->json([
                'msg'   => 'Prodcut Deleted Successfully',
                'count' => Auth::user()->wishlist()->count(),
                'id'    => $wishlist->id
            ]);
        } else {
            return redirect()->route('blog.index')->with(['error' => $response->message()]);
        }
    }

    /**
     * Remove All the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        if (!Auth::user()->wishlist()->count() > 0) {
            return response()->json([
                'err' => "There's No Prodcuts In Wishlist"
            ]);
        }

        Auth::user()->wishlist()->delete();

        return response()->json([
            'msg'   => 'Wishlist Cleared Successfully',
            'count' => Auth::user()->wishlist()->count()
        ]);
    }
}
