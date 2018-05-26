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
    <h2>登入會員</h2>
    @include('components.validatorErrorMessage')
    <form action="{{url('login')}}" id="loginForm" method="post">
        {{csrf_field()}}
        <label for="user">請輸入帳號：</label>
        <input name="user" id="user" type="text" class="form-control" placeholder="請輸入帳號" value="{{old('user')}}" required>
        <label for="pwd">請輸入密碼：</label>
        <input name="pwd" id="pwd" type="password" class="form-control" placeholder="請輸入密碼" required>
        <label for="captcha"></label>
        <table id="captcha">

        </table>
        <button type="submit" class="btn btn-success fill">登入</button>
        <script>
            var ans = {
                    '連成水平線': [
                        [1, 2, 3],
                        [4, 5, 6],
                        [7, 8, 9]
                    ],
                    '連成垂直線': [
                        [1, 4, 7],
                        [2, 5, 8],
                        [3, 6, 9]
                    ],
                    '連成斜線': [
                        [1, 5, 9],
                        [3, 5, 7]
                    ],
                };
                var keys = Object.keys(ans);
                var index = Math.floor(Math.random() * 3);
                var key = keys[index];
                var target = ans[key];
                $("[for=captcha]").text(key);
                for (var i = 1; i <= 3; i++) {
                    $("#captcha").append($("<tr>"));
                    for (var j = 1; j <= 3; j++) {
                        var td = $("<td>").attr('data-id', (i - 1) * 3 + j);
                        $("#captcha tr").last().append(td);
                    }
                }
                $('#captcha td').click(function () {
                    $(this).toggleClass("active");
                });
                $("#loginForm").on('submit',function () {
                    var data = [];
                    $(".active").each(function () {
                        data.push($(this).data('id'));
                    });
                    if(data.length == 3 && target.some(x => x.filter(y => data.includes(y)).length == 3)){
                        return true;
                    }else{
                        alert('圖形錯誤，請重試!');
                        return false;
                    }
                });
        </script>
        <style>
            #captcha{
                width:100%;
            }
            aside{
                margin-top:20px;
            }
        </style>
    </form>
</div>
    @include('components.aside')
@endsection

@section('footer')
    @include('components.footer')
@endsection
