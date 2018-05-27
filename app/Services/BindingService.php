<?php
namespace App\Services;

use App\User;
use App\Article;

class BindingService
{
    static function binding(){
        if(session()->has('user')){
            $binding = [
                'dropMenu' => [
                    ['title'=>'使用者：'.session('name'),'subMenu'=>[
                        ['url'=>url('/user/updatePwd'),'title'=>'修改密碼'],
                        'divider',
                        ['url'=>url('/user/logout'),'title'=>'登出'],
                    ]],
                ],
                'navMenu'=>[],
            ];
        }else{
            $binding = [
                'dropMenu' =>[],
                'navMenu' => [
                    ['url'=>url('/login'),'title'=>'登入'],
                ]
            ];
        }
        array_push($binding['dropMenu'],['title'=>'相片瀏覽','subMenu'=>[]]);
        $fileTitle = [
            'culture'=>'日本文化體驗',
            'University'=>'大學及農業試驗所參訪見學',
            'communicate'=>'日本高校交流',
            'enterprise'=>'企業參訪見學',
            'farmhouse'=>'農家寄宿體驗',
        ];
        $index = count($binding['dropMenu'])-1;
        $binding['categories'] = Article::whereNotIn('category',$fileTitle)->get()->pluck('category')->unique()->toarray();
        // dd($binding);
        foreach(glob('./images/category/*') as $dir){
            $file = array_reverse(explode('/',$dir))[0];
            array_push($binding['dropMenu'][$index]['subMenu'],['url'=>url('/photo/category/'.$file),'title'=>$fileTitle[$file]]);
            array_unshift($binding['categories'],$fileTitle[$file]);
        }


        return $binding;
    }
}
