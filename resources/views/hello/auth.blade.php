@extends('auth_layout')

@section('content')
    <div class="container mt-4">
        ログインページ

        <br>
        <p>会員情報入力</p>
        {{$message}}
        <table>
            <form action="hello" method="POST">
            @csrf
                <tr><th></th><th></th></tr>
                <tr><td>email</td><td><input type="text" name="email"></td></tr>
                <tr><td>password</td><td><input name="password" type="password"></td></tr>
                <tr><td></td><td><input type="submit" value="LogIn"></td></tr>
            </form>
        </table>
        <a
            class="bun btn-primary"
            type="submit"
            name="register"
            id="register"
            href="/hello/register"
        >新規会員登録</a>
    </div>
    @if(isset($users))
        {{$users}}
    @endif
    <button type="button" class="btn btn-primary">Primary</button>
    <button type="button" class="btn btn-secondary">Secondary</button>
    <button type="button" class="btn btn-success">Success</button>
    <button type="button" class="btn btn-danger">Danger</button>
    <button type="button" class="btn btn-warning">Warning</button>
    <button type="button" class="btn btn-info">Info</button>
    <button type="button" class="btn btn-light">Light</button>
    <button type="button" class="btn btn-dark">Dark</button>

    <button type="button" class="btn btn-link">Link</button>
@endsection