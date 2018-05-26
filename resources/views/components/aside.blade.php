<aside>
    <header>
        <b>文章分類：</b>
    </header>
    <form action="{{url('/search')}}" method="post">
        {{csrf_field()}}
        @forelse ($categories as $category)
        <li class="btn fill categoryLi">
            <button class="defaultBtn" type="submit" name="search" value="{{$category}}">{{$category}}</button>
        </li>
        @if ($loop->last)
        <li class="btn fill categoryLi">
            <a class="defaultBtn" href="{{url('/')}}">全部一覽</a>
        </li>
        @endif @empty
        <li class="btn fill categoryLi">沒有任何類別</li>
        @endforelse
    </form>
</aside>

<style>

    .categoryLi{
        padding:0;
        height:34px;
    }
    .defaultBtn {
        width:100%;
        height:34px;
        border: 0px;
        background-color: transparent;
        line-height:34px;
        color:#333;
        display:block;
    }
    .defaultBtn:hover{
        text-decoration: none;
        color:#333;
    }
</style>
