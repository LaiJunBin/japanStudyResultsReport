@extends('layout')
@section('title',"106金手獎赴日技職研習成果網站")
@section('header')
    @include('components.navbar')
    @include('components.slideshow')
@endsection

@section('content')
    @include('components.aside')
    @include('components.article')
    <style>
        @media screen and (max-width: 768px) {
            aside {
                display: unset;
            }
        }

    </style>
    <script>
        var isChrome = !!window.chrome && !!window.chrome.webstore;
        if(!isChrome && sessionStorage.chrome == undefined){
            sessionStorage.chrome = true;
            alert('建議使用Chrome瀏覽器瀏覽');
        }
        console.log(document.cookie);
    </script>
@endsection

@section('footer')
    @include('components.footer')
@endsection

