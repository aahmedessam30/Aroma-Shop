<?php

namespace App\Http\Controllers;

use App\Models\Prodcut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProdcutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Prodcut $prodcut)
    {
        return view('shop.prodcut-details', ['prodcut' => $prodcut]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function review_store(ReviewRequest $request)
    {
        try {
            $review = Review::create([
                'user_id'    => Auth::id(),
                'prodcut_id' => $request->prodcut_id,
                'review'     => $request->review,
                'rate'       => $request->rate[0]
            ]);

            $html = view('render.review', ['review' => $review])->render();

            if (request()->ajax()) {
                return response()->json([
                    'msg'  => 'Review Saved Successfully',
                    'html' => $html
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'err' => 'an error occurred',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reply_store(ReplyRequest $request)
    {
        try {
            Reply::create([
                'user_id'    => Auth::id(),
                'comment_id' => $request->comment_id,
                'reply'      => $request->reply,
            ]);

            return response()->json([
                'msg'  => 'Reply Saved Successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'err' => 'an error occurred',
            ]);
        }
    }
}
