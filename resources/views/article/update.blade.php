@extends('../layout')
@section('title',"106金手獎赴日技職研習成果網站")
@section('header')
    @include('../components.navbar')
@endsection


@section('content')
<h2>
    編輯文章
</h2>
<a href="{{url('/'.$article['id'])}}" class="btn btn-default">
    <span class="glyphicon glyphicon-arrow-left"></span>
    回文章</a>
    @include('components.validatorErrorMessage')
<form action="{{url('/article/update/'.$article['id'])}}" method="post">
    {{csrf_field()}}
    {{method_field('put')}}
    <label for="title">請輸入標題：</label>
    <input name="title" id="title" type="text" class="form-control" placeholder="請輸入標題" value="{{old('title')??$article['title']}}" required>
    <button type="button" class="btn btn-default active categoryBtn" data-id="0">選擇類別</button>
    <button type="button" class="btn btn-default categoryBtn" data-id="1">新增類別</button>
    <div id="category">
        <div>
            <label for="selectCategory">選擇文章分類：</label>
            <select name="category" id="selectCategory" class="form-control">
                @forelse ($categories as $category)
                    <option value="{{$category}}" @if ($article['category'] == $category)
                        selected
                    @endif>{{$category}}</option>
                @empty
                    <option selected>沒有分類</option>
                @endforelse

            </select>
        </div>
        <div style="display:none;">
            <label for="inputCategory">新增類別：</label>
            <input type="text" id="inputCategory" name="category" class="form-control" placeholder="請輸入類別" value="{{old('category')}}"
                disabled required>
        </div>
    </div>


    <label for="content">內文：</label>
    <textarea name="content" id="content"></textarea>
    <button type="submit" class="btn btn-success fill">編輯文章</button>
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <script>
        $(".categoryBtn").click(function(){
                var id = $(this).data('id');
                $("#category div").hide();
                $("#category").find('input,option').prop('disabled',true);
                $("#category div").eq(id).show();
                $("#category div").eq(id).find('input,option').prop('disabled',false);
                $(".categoryBtn").removeClass('active');
                $(this).addClass('active');

            });
            var data = `{!! old('content')??$article['content'] !!}`;
            $("[name=content]").html(data);
            CKEDITOR.replace('content');

            var uploadImage = setInterval(function(){
                if($("#cke_26").length>0){
                    $("#cke_26").remove();
                    clearInterval(uploadImage);
                    return;
                }
            },1);

    </script>
@endsection

@section('footer')
    @include('../components.footer')
@endsection

<style>
    form * {
        margin: 3px 0 !important;
    }
</style>
