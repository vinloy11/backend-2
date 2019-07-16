<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Post;
use App\Topic;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Requests\TopicStoreRequest;

class TopicController extends Controller
{
    public function index() {
        $topics = Topic::latestFirst()->paginate(5);
        return TopicResource::collection($topics);
    }

    public function store(TopicStoreRequest $request) {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post;
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);

        return new TopicResource($topic);
    }


}
