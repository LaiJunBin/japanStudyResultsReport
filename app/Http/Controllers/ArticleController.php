<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\User;
use App\Article;
use Validator;

class ArticleController extends Controller
{
    function add(){
        $binding = BindingService::binding();
        $binding['categories'] = Article::get()->pluck('category')->unique();
        return view('article.add',$binding);
    }

    function addProcess(){
        $input = request()->all();
        $rules = [
            'category'=>[
                'required',
                'min:1',
            ],
            'content'=>[
                'required',
            ],
        ];

        if(($input['different']??"") == $input['category']){
            return redirect('/article/add')->withErrors('必須選擇類別')->withInput();
        }
        $validator = Validator::make($input,$rules);
        if($validator->fails()){
            return redirect('/article/add')->withErrors($validator)->withInput();
        }

        $input['name'] = session('name');
        Article::create($input);
        return redirect('/');
    }
}
