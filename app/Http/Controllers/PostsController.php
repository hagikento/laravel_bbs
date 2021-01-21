<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        $param = [
            'posts' => $posts,
            'user' => $user,
        ];
        return view('posts.index',$param);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        return view('posts.create',['user' => $user]);
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'user_name' => 'required',
        ]);
        Post::create($params);
        return redirect()->route('top');
    }

    public function show($post_id,Request $request)
    {
        $user = Auth::user();
        $post = Post::findOrFail($post_id);
        return view('posts.show',['post'=>$post, 'user'=>$user]);
    }

    public function edit($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('posts.edit',['post'=>$post]);
    }

    public function update($post_id,Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ]);

        $post = Post::findOrFail($post_id);
        $post->fill($params)->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);

        \DB::transaction(function() use ($post) {
            $post->comments()->delete();
            $post->delete();
        });

        return redirect()->route('top');
    }
}
