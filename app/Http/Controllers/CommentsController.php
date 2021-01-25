<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|max:2000',
            'user_name' => 'required',
        ]);

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);

        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit',['comment' => $comment]);
    }

    public function update($id,Request $request)
    {
        $params = $request->validate([
            'body' => 'required|max:200',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->fill($params)->save();
        $post = $comment->post;

        return redirect()->route('posts.show',['post'=>$post]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post = $comment->post;
        \DB::table('comments')->where('id',$id)->delete();
        return redirect()->route('posts.show',['post'=>$post]);
    }

    public function like($id)
    {
        Like::create([
        'comment_id' => $id,
        'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'You Liked the Reply.');

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('comment_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        session()->flash('success', 'You Unliked the Reply.');

        return redirect()->back();
    }

}
