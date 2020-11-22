<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Notifications\Post\PostStatusNotification;
use App\User;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * @var string
     */
    private $base;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->base = 'posts';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(sprintf('%s.create', $this->base));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Post\StorePostRequest $request
     * @return void
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());

        $this->sendPostNotification($post, 'updated');

        return redirect($this->base)->with('success', 'Post saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view(sprintf('%s.show', $this->base), compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view(sprintf('%s.edit', $this->base), compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        $this->sendPostNotification($post, 'updated');

        return redirect($this->base)->with('success', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect($this->base)->with('success', 'Post deleted!');
    }

    private function sendPostNotification(Post $post, string $status)
    {
        Notification::send(User::all(), new PostStatusNotification($post, $status));
    }
}
