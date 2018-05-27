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
@endsection

@section('footer')
    @include('components.footer')
@endsection

