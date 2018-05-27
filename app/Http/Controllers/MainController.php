<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\User;
use App\Article;
use Hash;

class MainController extends Controller
{
    function index(){
        if(session()->has('search'))
            session()->forget('search');
        $binding = BindingService::binding();
        $binding['images'] = glob('./images/slideShow/*.jpg');
        $binding['articles'] = Article::paginate(5);
        //dd($binding);
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

    function photo_day($day){
        $binding = BindingService::binding();
        $binding['images'] = [];
        $binding['day'] = $day;
        $images = array_reverse(glob('./images/day/'.$day.'/*'));
        for($i = 0;$i<count($images);$i++){
            $url = $images[$i];
            $img = getimagesize($url);
            $height = $img[1] / ($img[0]/340);
            array_push($binding['images'],['url'=>$url,'height'=>$height]);
        }

        return view('photoDay',$binding);
    }

    function searchProcess(){
        $input = request()->all();
        session()->put('search',$input['search']);
        return redirect('/search');
    }

    function search(){
        $binding = BindingService::binding();
        $binding['images'] = glob('./images/slideShow/*.jpg');
        $binding['articles'] = Article::where('category',session('search'))->paginate(5);
        return view('index',$binding);
    }
}
