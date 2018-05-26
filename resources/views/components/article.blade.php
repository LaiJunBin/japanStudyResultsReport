<article>
    <header>
        <a href="{{url('/article/add')}}" class="btn btn-info fill">新增文章</a>
    </header>
    <main>
        @forelse ($articles as $article)
            <div class="article">
                <h2 class="articleTitle">
                    <a href="{{url('/'.$article['id'])}}">{{$article['title']}}</a>
                </h2>
                <h4>類別：{{$article['category']}}</h4>
                <div>
                    {{$article['name']}}於{{$article['created_at']}}發文
                </div>
                <div class="viewArticle">
                    <a href="{{url('/'.$article['id'])}}">查看文章...</a>
                </div>
            </div>
        @empty
            沒有任何文章
        @endforelse
    </main>
</article>

<style>
    .article:nth-child(odd){
        background: #efefef;

    }
    .article{
        padding:20px;
    }
    a{
        color:#333;
        text-decoration: none;
    }
    .articleTitle a:hover{
        color:#222;
        font-size:31px;
    }
    .viewArticle{
        text-align:right;
    }
</style>
