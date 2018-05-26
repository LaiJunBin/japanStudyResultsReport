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
        return $binding;
    }
}
