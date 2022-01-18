<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Prodcut;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prodcuts = Prodcut::latest()->take(8)->get();
        $topProdcuts = Prodcut::topProdcuts();
        $posts = Post::latest()->take(3)->get();
        return view('home', ['prodcuts' => $prodcuts, 'topProdcuts' => $topProdcuts, 'posts' => $posts]);
    }
}
