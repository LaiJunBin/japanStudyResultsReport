<aside>
    <header>
        <b>文章分類：</b>
    </header>
    @forelse ($categories as $category)
    <li class="btn fill">{{$category}}</li>
    @empty
    <li class="btn fill">沒有任何類別</li>
    @endforelse
</aside>
