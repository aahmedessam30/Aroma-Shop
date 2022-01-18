<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();

        $categories = PostCategory::all();
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        $popularPosts = Post::where('views', '>', '200')->take(8)->get();

        return view('blog.index', ['categories' => $categories, 'posts' => $posts, 'popularPosts' => $popularPosts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($validated['image']) {
                $validated['image'] = Helper::uploadImage($validated['image'], 'posts');
            }

            Auth::user()->posts()->create($validated);

            return redirect()->route('blog.index')->with(['success' => 'Post Added Successfully']);
        } catch (Exception $e) {
            return redirect()->route('blog.index')->with(['error' => 'an error occurred']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        Paginator::useBootstrap();

        $categories = PostCategory::all();
        $popularPosts = Post::where('views', '>', '200')->take(8)->get();

        $post->views += 1;
        $post->save();

        return view('blog.blog-details', ['post' => $post, 'categories' => $categories, 'popularPosts' => $popularPosts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $response = Gate::inspect('update', $post);

        if ($response->allowed()) {
            try {
                $categories = PostCategory::all();
                $popularPosts = Post::where('views', '>', '200')->take(8)->get();

                return view('blog.edit-post', ['post' => $post, 'categories' => $categories, 'popularPosts' => $popularPosts]);
            } catch (Exception $e) {
                return redirect()->route('blog.index')->with(['error' => 'an error occurred']);
            }
        } else {
            return redirect()->route('blog.index')->with(['error' => $response->message()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            $validated = $request->validated();

            if ($request->image) {
                $validated['image'] = Helper::uploadImage($validated['image'], 'posts');
            }

            $post->update($validated);

            return redirect()->route('blog.index')->with(['success' => 'Post Updated Successfully']);
        } catch (Exception $e) {
            return redirect()->route('blog.index')->with(['error' => 'an error occurred']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $response = Gate::inspect('delete', $post);

        if ($response->allowed()) {
            try {
                if ($post->image) {
                    unlink(public_path('storage/' . $post->image));
                }
                $post->delete();
                return response()->json([
                    'msg' => 'Post Deleted Successfully',
                    'id'  => $post->id
                ]);
            } catch (Exception $e) {
                return redirect()->route('blog.index')->with(['error' => 'an error occurred']);
            }
        } else {
            return redirect()->route('blog.index')->with(['error' => $response->message()]);
        }
    }

    public function filter(Category $category)
    {
        Paginator::useBootstrap();

        $posts = Post::where('post_category_id', $category->id)->paginate(5);
        $html = view('render.blog', ['posts' => $posts])->render();

        if (request()->ajax()) {
            return response()->json(['html' => $html]);
        }
    }
}
