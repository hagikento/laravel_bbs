<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HelloController extends Controller
{
    public function getLogin(Request $request)
    {
        $message ='';
        $message=$request->message;
        $users = User::orderBy('id','asc')->get();
        return view('hello.auth',['message'=>$message,'users'=>$users]);
    }

    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $params = [
            'email'=>$email,
            'password'=>$password,
        ];
        if(Auth::attempt($params)){
            return redirect()->route('top');
        }else{
            $message = 'ログインに失敗しました';
            return view('hello.auth',['message'=>$message]);
        }
    }
    public function getLogOut()
    {
        Auth::logout();
        return redirect()->route('top');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $params = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        Auth::create($params);
        return redirect()->route('top');

    }

}
