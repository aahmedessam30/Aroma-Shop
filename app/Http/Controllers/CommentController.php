<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        try {
            if ($request->prodcut_id) {
                $comment = Comment::create([
                    'user_id'    => Auth::id(),
                    'prodcut_id' => $request->prodcut_id,
                    'comment'    => $request->comment,
                ]);

                $html = view('render.prodcut-comment', ['comment' => $comment])->render();
            } elseif ($request->post_id) {
                $comment = Comment::create([
                    'user_id'    => Auth::id(),
                    'post_id'    => $request->post_id,
                    'comment'    => $request->comment,
                ]);

                $html = view('render.post-comment', ['comment' => $comment])->render();
            }

            if (request()->ajax()) {
                return response()->json([
                    'msg'  => 'Comment Saved Successfully',
                    'html' => $html
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'err' => 'an error occurred',
            ]);
        }
    }
}
