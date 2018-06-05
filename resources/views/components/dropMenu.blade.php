@foreach ($menu['subMenu'] as $subMenu)
    @if ($subMenu == 'divider')
        <li class="divider"></li>
    @else
        @if (!array_has($subMenu,'subMenu'))
            <li>
                <a class="btn btn-sm" href="{{$subMenu['url']}}">{{$subMenu['title']}}</a>
                @if (array_has($categoriesImagesCounts,$subMenu['title']))
                    <span class="badge">{{$categoriesImagesCounts[$subMenu['title']]}}</span>                    
                @endif
            </li>

        @elseif (count($subMenu['subMenu'])>0)

        <li class="dropdown">
                <a class="btn btn-sm" href="#">{{$subMenu['title']}}</a>
                <ul class="dropdown-menu">
                    @include('components.dropMenu',['menu'=>$subMenu,'index'=>1])
                </ul>
        </li>
        @endif

    @endif
@endforeach

