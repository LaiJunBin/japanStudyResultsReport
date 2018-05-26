<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\User;
use App\Article;
use Validator;

class ArticleController extends Controller
{
    function viewArticle($id){
        $binding = BindingService::binding();
        $query = Article::where('id',$id)->first()->toarray();
        $binding['article'] = $query;
        $binding['manageable'] = $query['name'] == session('name')??null;
        return view('article.index',$binding);
    }
    function add(){
        $binding = BindingService::binding();
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

        if('沒有分類' == $input['category']){
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

    function update($id){
        $binding = BindingService::binding();
        $binding['article'] = Article::where('id',$id)->first()->toarray();
        return view('article.update',$binding);
    }

    function updateProcess($id){
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

        $validator = Validator::make($input,$rules);
        if($validator->fails()){
            return redirect('/article/update/'.$id)->withErrors($validator)->withInput();
        }


        Article::where('id',$id)->update([
            'title' =>$input['title'],
            'category' =>$input['category'],
            'content'=>$input['content']
        ]);
        return redirect('/'.$id);
    }

    function delete($id){
        Article::where('id',$id)->delete();
        return redirect('/');
    }
}
