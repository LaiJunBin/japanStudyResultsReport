<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\User;
use Hash;

class MainController extends Controller
{
    function index(){
        $binding = BindingService::binding();
        return view('index',$binding);
    }

    function login(){
        $binding = BindingService::binding();
        return view('login',$binding);
    }

    function loginProcess(){
        $input = request()->input();
        $query = User::where([
            'user'=>$input['user'],
            ])->first();
        if($query==null || !(Hash::check($input['pwd'],$query->pwd))){
            return redirect('/login')->withErrors('帳號或密碼錯誤')->withInput();
        }else{
            session()->put('user',$query->user);
            session()->put('name',$query->name);
            return redirect('/');
        }
    }
}
