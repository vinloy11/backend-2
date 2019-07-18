<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
//use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Topic;
class PostController extends Controller
{
    public function store(StorePostRequest $request, Topic $topic) {
        $post = new Post();
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->posts()->save($post);
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Topic $topic, Post $post) {
        $this->authorize('update', $post);
        $post->body = $request->get('body', $post->title);
        $post->save();
        return new PostResource($post);
    }

    public function destroy(Topic $topic, Post $post) {
        $this->authorize('destroy', $post);
        $post->delete();
        return response(null, 204);
    }

}