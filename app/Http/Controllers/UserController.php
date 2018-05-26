<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\User;
use Validator;
use Hash;

class UserController extends Controller
{
    function logout(){
        session()->forget('user');
        session()->forget('name');
        return redirect('/');
    }

    function updatePwd(){
        $binding = BindingService::binding();
        return view('user.updatePwd',$binding);
    }

    function updatePwdProcess(){
        $input = request()->all();

        $query = User::where('user',session('user'))->first();
        if(!(Hash::check($input['oldPwd'],$query->pwd)))
            return redirect('user/updatePwd')->withErrors('舊密碼錯誤!');

        $rules = [
            'newPwd'=>[
                'required',
                'max:191',
                'same:newPwd_repeat',
            ],
            'newPwd_repeat'=>[
                'required',
                'max:191'
            ],
        ];


        $validator = Validator::make($input,$rules);
        if($validator->fails()){
            return redirect('/user/updatePwd')->withErrors($validator);
        }
        $query->update([
            'pwd'=>Hash::make($input['newPwd'])
        ]);
        return redirect('/');
    }
}
