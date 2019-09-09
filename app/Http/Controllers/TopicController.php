<?php

namespace App\Http\Controllers;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
class TopicController extends Controller
{
    public function __construct() {
        return $this->middleware('auth:api', ['only' => ['store', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $topics = Topic::latestFirst()->paginate(5);
        return TopicResource::collection($topics);
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
    public function store(TopicCreateRequest $request) {
        // Topic
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());
        // Posts
        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);
        return new TopicResource($topic);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic) {
        return new TopicResource($topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicRequest $request, Topic $topic) {
        $this->authorize('update', $topic);
        $topic->title = $request->get('title', $topic->title);
        $topic->save();
        return new TopicResource($topic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic) {
        $this->authorize('destroy', $topic);
        $topic->delete();
        return response(null, 204);
    }
}
