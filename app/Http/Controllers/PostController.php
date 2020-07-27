<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request) 
    {
        $data = $request->only('title', 'body');

        $data['slug'] = str_slug($data['title']);
        $data['user_id'] = Auth::user()->id;

        $post = Post::create($data);
        
        return redirect()->route('edit_post', ['id' => $post->id]);
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('title', 'body');

        $data['slug'] = str_slug($data['title']);
        $data['user_id'] = Auth::user()->id;

        $post = Post::create($data);

        return back();
    }

    public function show($id)
    {
        $post = Post::published()->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function published($id) 
    {
        $post = Post::find($id);
        $post->published = true;

        $post->save();

        return back();
    }

    public function drafts() 
    {
        $postsQuery = Post::unpublished();

        if (Gate::denies('post.draft')) {
            $postsQuery = $postsQuery->where('user_id', Auth::user()->id);
        }

        $posts = $postsQuery->paginate();
        return view('posts.drafts', compact('posts'));
    }

    public function test()
    {
        return redirect()->route('test', ['id' => 1]);
    }
}
