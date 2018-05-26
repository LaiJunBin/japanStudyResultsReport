@extends('layout')
@section('title',"106金手獎赴日技職研習成果網站")
@section('header')
    @include('components.navbar')
@endsection

@section('content')
    <article class="article">
        <h2>
            <div>{{$article['title']}}</div>
            @if ($manageable)
                <div>
                    <form id="deleteForm" action="{{url('/article/delete/'.$article['id'])}}" method="post">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <a href="{{url('/article/update/'.$article['id'])}}" class="btn btn-warning">編輯</a>
                        <button type="submit" class="btn btn-danger">刪除</a>
                    </form>
                    <script>
                        $("#deleteForm").on('submit',function(){
                            return confirm('確定要刪除嗎?刪除後無法復原');
                        });
                    </script>
                </div>
            @endif
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
    .article>h2,.article>h2>div{
        display:inline-block;
    }
    .article main{
        font-size:16px;
    }
    aside{
        margin-top:40px;
    }
</style>
