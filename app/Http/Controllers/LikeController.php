<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct() {
        return $this->middleware('auth:api', ['only' => ['store']]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Topic $topic, Post $post) {
        $this->authorize('like', $post);
        // check
        if ($request->user()->hasLikedPost($post)) {
            return response(null, 409);
        } // end if
        // create like
        $like = new Like;
        $like->user()->associate($request->user());
        $post->likes()->save($like);
        return response(null, 204);
    } // end store
}
