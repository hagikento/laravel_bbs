<! DOCTYPE html>
<html lang="en">
<head>
    <meta cahrset="UTF-8">
    <title>Laravel BBS</title>
    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    >
</head>
<body>
    <header class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="nevbar-brand" href="{{url('')}}">
                Laravel BBS
            </a>
            @if(Auth::check())
                <div class="text-info">
                <p>name: {{$user->name}}</p>
                @else
                <p>ログインしていません</p>
                </div>
            @endif
        </div>
    </header>

    <div>
        @yield('content')
    </div>
</body>
</html>
