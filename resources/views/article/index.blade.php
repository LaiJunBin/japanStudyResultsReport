@extends('layout')
@section('title',"106金手獎赴日技職研習成果網站")
@section('header')
    @include('components.navbar')
@endsection

@section('content')
    <article class="article">
        <h2 >
            {{$article['title']}}
        </h2>
        <h4>類別：{{$article['category']}}</h4>
        <div>
            {{$article['name']}}於{{$article['created_at']}}發文
        </div>
        <br>
        <main>
            {!! $article['content'] !!}
        </main>
    </article>
    @include('components.aside')
@endsection

@section('footer')
    @include('components.footer')
@endsection
<style>
    .article{
        padding:20px;

    }
    .article main{
        font-size:16px;
    }
    aside{
        margin-top:40px;
    }
</style>
