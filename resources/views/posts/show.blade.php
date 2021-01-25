@extends('layout')

@section('content')
    @if(Auth::check())
        <p>name: {{$user->name}}</p>
    @else
        <p>ログインしていません</p>
    @endif
    <div class="container mt-4">
        <div class="border p-4">
            <div class="mb-4 text-right">
                @if( isset($user) && $user->name  ===  $post->user_name )
                    <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
                        編集する
                    </a>
                    <form
                        style="display: inline-block;"
                        method="POST"
                        action="{{ route('posts.destroy', ['post' => $post]) }}"
                    >
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger">削除する</button>
                    </form>
                @endif
            </div>

            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>

            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>

            <section>
                @if(isset($user))
                <h2 class="h5 mb-4">
                    コメント
                </h2>

                <form class="mb-4" method="POST" action="{{ route('comments.store',[ 'post' => $post ]) }}">
                    @csrf

                    <input
                        name='user_name'
                        type="hidden"
                        value="{{$user->name}}">

                    <input
                        name="post_id"
                        type="hidden"
                        value="{{ $post->id }}"
                    >

                    <div class="form-group">
                        <label for="body">
                            本文
                        </label>

                        <textarea
                            id="body"
                            name="body"
                            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            コメントする
                        </button>
                    </div>
                </form>
                @endif

                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <div class="text-right">
                            name: {{$comment->user_name}}
                        </div>
                        <div>
                        @if($comment->is_liked_by_auth_user())
                            <a href="{{ route('comment.unlike', ['id' => $comment->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $comment->likes->count() }}</span></a>
                        @else
                            <a href="{{ route('comment.like', ['id' => $comment->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $comment->likes->count() }}</span></a>
                        @endif
                        </div>
                        @if( isset($user) && $user->name  ===  $comment->user_name )
                            <div class="mb-4 text-right">
                                <a class="btn btn-primary" href="{{ route('comments.edit', ['comment' => $comment]) }}">
                                    コメント編集
                                </a>
                                <form
                                    style="display: inline-block;"
                                    method="POST"
                                    action="{{ route('comments.destroy', ['comment' => $comment]) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">削除する</button>
                                </form>
                            </div>
                        @endif
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        </div>
    </div>
@endsection
