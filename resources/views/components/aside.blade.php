<aside>
    <header>
        <b>文章分類：</b>
    </header>
    {{--  {{dd($categories)}}  --}}
    <form action="{{url('/search')}}" method="post">
        {{csrf_field()}}
        @forelse ($categories as $category => $values)
        {{--  {{dd($category,$value)}}  --}}
        <li class="btn fill categoryLi">
            <button class="defaultBtn dropBtn" data-id="{{$loop->index}}" type="button">{{$category}}</button>
        </li>
        @foreach ($values as $item)
            <li class="btn fill categoryLi dropLi" va="{{$loop->parent->index}}">
                <button class="defaultBtn " type="submit" name="search" value="{{$item}}">{{$item}}</button>
            </li>
        @endforeach
        @if ($loop->last)
        <li class="btn fill categoryLi">
            <a class="defaultBtn" href="{{url('/')}}">全部一覽</a>
        </li>
        @endif @empty
        <li class="btn fill categoryLi">沒有任何類別</li>
        @endforelse
        <script>
            $(".dropBtn").click(function(){
                var index = $(this).data('id');
                $(".dropLi").slideUp();
                if($(this).hasClass('active')){
                    $('.dropBtn').removeClass('active');
                }else{
                    $('.dropBtn').removeClass('active');
                    $(this).addClass('active');
                    $(`.dropLi[va=${index}]`).slideDown();
                }
            });
            function layout(){
                $(".categoryLi").each(function(){
                    var length = $(this).find('button').text().length;
                    $(this).css('font-size',Math.min(13/length,1.08) + 'em');
                })
            }
            $(window).resize(function(){
                layout();
            });
            layout();
        </script>
    </form>
</aside>

<style>
    .dropLi{
        display:none;
        list-style:none;
        background-image: linear-gradient(to bottom,#5bc0de 0,#2aabd2 100%);
        border-color: #28a4c9;
        color:#fff;
    }
    .categoryLi{
        padding:0;
        height:34px;
    }

    .defaultBtn.active{
        background-image: linear-gradient(to bottom,#337ab7 0,#2e6da4 100%);
        background-color: #2e6da4;
        color: #fff;
    }

    .defaultBtn {
        width:100%;
        height:34px;
        border: 0px;
        background-color: transparent;
        line-height:34px;
        display:block;
    }
    .defaultBtn:hover{
        text-decoration: none;
    }

    a.defaultBtn{
        color:#333 !important;
    }
</style>
