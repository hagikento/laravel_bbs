@extends('layout')

@section('content')
    @owner
    <a class="" href="{{route('user.index')}}"> 管理者ページ</a>
    @endowner
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <a class="btn badge-primary" href="/hello/logout">
        Logout
    </a>
    <br></br>

    <div class="mb-4">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            投稿を新規作成する
        </a>
    </div>
    <div class="container mt-4">
        @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card header">
                    {{$post->title}}
                </div>
                <div class="card body">
                    <p class="card-text">
                        {!! nl2br(e(Str::limit($post->body, 200))) !!}
                    </p>

                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                        続きを読む
                    </a>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時{{$post->created_at->format('Y.m.d')}}
                    </span>

                    @if ($post->comments->count())
                        <span class="badge badge-primary">
                            コメント{{$post->comments->count()}}件
                        </span>
                    @endif
                    <span class="mr-2">
                        投稿者: {{$post->user_name}}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mb-5">
        {{$posts->onEachSide(3)->links('vendor.pagination.default')}}
    </div>
@endsection



