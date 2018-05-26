<?php
namespace App\Services;

use App\User;

class BindingService
{
    static function binding(){
        if(session()->has('user')){
            $binding = [
                'dropMenu' => [
                    ['title'=>'使用者：'.session('name'),'subMenu'=>[
                        ['url'=>'/user/updatePwd','title'=>'修改密碼'],
                        'divider',
                        ['url'=>'/user/logout','title'=>'登出'],
                    ]],
                ],
                'navMenu'=>[],
            ];
        }else{
            $binding = [
                'dropMenu' =>[],
                'navMenu' => [
                    ['url'=>'login','title'=>'登入'],
                ]
            ];
        }
        array_push($binding['dropMenu'],
        ['title'=>'相片瀏覽','subMenu'=>[
            ['url'=>'/photo/day/1','title'=>'第一天'],
            ['url'=>'/photo/day/2','title'=>'第二天'],
            ['url'=>'/photo/day/3','title'=>'第三天'],
            ['url'=>'/photo/day/4','title'=>'第四天'],
            ['url'=>'/photo/day/5','title'=>'第五天'],
            ['url'=>'/photo/day/6','title'=>'第六天'],
            ['url'=>'/photo/day/7','title'=>'第七天'],
            ['url'=>'/photo/day/8','title'=>'第八天'],
        ]]);
        return $binding;
    }
}
