<?php
namespace App\Services;

use App\User;

class BindingService
{
    static function binding(){
        if(session()->has('user_name')){
            $binding = [
                'navMenu' => [
                    ['url'=>'user/update-password','title'=>'修改密碼'],
                    'divider',
                    ['url'=>'user/logout','title'=>'登出'],
                ],
                'user_name' => '使用者：'.session('user_name'),
                'user_type' => User::where('email',session('user_email'))->first()->only('type')['type']
            ];
        }else{
            $binding = [
                'navMenu' => [
                    ['url'=>'user/login','title'=>'登入'],
                ]
            ];
        }
        return $binding;
    }
}