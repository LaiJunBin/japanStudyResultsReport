@extends('layout')
@section('title',"106金手獎赴日技職研習成果網站")
@section('header')
    @include('components.navbar')
    @include('components.slideshow')
@endsection

@section('content')
    @include('components.article')
    @include('components.aside')
@endsection

@section('footer')
    @include('components.footer')
@endsection
