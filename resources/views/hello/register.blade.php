@extends('auth_layout')

@section('content')
<p style="font-size:30pt">新規アカウント作成</p>
<table>
    <form action="/hello" method="POST">
    @if($errors->count())
        {{$errors->get()}}
    @endif
    @csrf
        <tr><th>Name: </th><td><input type="text" name="name"></td></tr>
        <tr><th>Email: </th><td><input type="text" name="email"></td></tr>
        <tr><th>Password: </th><td><input type="password" name="password"></td></tr>
        <tr><th>Confirm pass: </th><td><input type="password" name="confirm_pass"></td></tr>
        <tr><th></th><td><input type="submit" value="新規登録"></td></tr>
    </form>
</table>


@endsection