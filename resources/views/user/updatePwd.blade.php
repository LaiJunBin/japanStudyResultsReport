@extends('layout')
@section('title',"106金手獎赴日技職研習成果網站 - 登入")
@section('header')
    @include('components.navbar')
@endsection


@section('content')
<div class="left">
    <style>
        #captcha {
            border-collapse: collapse;
            width: 50vw;
            height: 50vh;
            margin: 10px auto;
        }

        #captcha td {
            border: 1px solid #333;
        }

        .active {
            background: #39f;
        }
    </style>
    <h2>修改密碼</h2>
    @include('components.validatorErrorMessage')
    <form action="{{url('user/updatePwd')}}" method="post">
        {{csrf_field()}} {{method_field('put')}}
        <label for="oldPwd">請輸入舊密碼：</label>
        <input name="oldPwd" id="oldPwd" type="password" class="form-control" placeholder="請輸入舊密碼" required>
        <label for="newPwd">請輸入新密碼：</label>
        <input name="newPwd" id="newPwd" type="password" class="form-control" placeholder="請輸入新密碼" required>
        <label for="newPwd_repeat">再次輸入新密碼：</label>
        <input name="newPwd_repeat" id="newPwd_repeat" type="password" class="form-control" placeholder="再次輸入新密碼" required>

        <button type="submit" class="btn btn-success fill">修改密碼</button>
    </form>
</div>
    @include('components.aside')
@endsection

@section('footer')
    @include('components.footer')
@endsection
<style>
    aside{
        margin-top:20px;
    }
</style>
