@extends('layout')
@section('title',"106金手獎赴日技職研習成果網站")
@section('header')
    @include('components.navbar')
    <div class="alert alert-warning" role="alert" style="text-align:center;">拖曳圖片至此頁面可上傳圖片</div>
@endsection












<style>
    #myUl {
        position: relative;
    }

    #myUl li {
        position: absolute;
        left: 0;
        top: 0;
        width: 340px;
        padding: 5px 10px;
    }

    img {
        width: 100%;
    }

    #bottom {
        width: 100%;
        position: absolute;
        text-align: center;
        height: 30px;
        margin-top: 15px;
        line-height: 0px;
    }

    .removeIcon {

        color: #ccc;
        z-index: 9;
        position: absolute !important;
        right: 20px !important;
        top: 20px !important;
    }

    .removeIcon:hover {
        cursor: pointer;
        transform: scale(1.2);
    }

    .container{
        position: relative;
        min-height: 100vh;
        z-index: 99;
    }

    #upload{
        position:fixed;
        text-align:center;
        line-height:calc(100vh - 100px);
        font-size:24px;
        background:rgba(51,153,255,.4);
        z-index:9;
        opacity: 0;
        transition:opacity .5s;
        color:chocolate;
    }

</style>












@section('content')
<div id="upload">
	拖曳圖片到這裡將立即上傳圖片
    
</div>
<ul class="nav" id="myUl">

</ul>
<script>
	$(".container")[0].ondragenter = function () {
		$("#upload").css('opacity',1);
	}

	$(".container").bind('dragleave dragend',function () {
		$("#upload").css('opacity',0);
	});

	$(".container")[0].ondragover = function () {
		$("#upload").css('opacity',1);
		return false;
	}
    @if (session()->has('name'))


        Array.prototype.removeAt = function (key) {
            return this.filter(function (item, index) {
                return index != key;
            });
        };

        

        $(".container")[0].ondrop = function (e) {
            e.preventDefault();
            $("#upload").css('opacity',0);
            if(e.dataTransfer.files.length>0){
                var filereader = new FileReader();

                for (var image of e.dataTransfer.files) {
                    if(image.type.indexOf('image')!=-1){
                        var formdata = new FormData();
                        formdata.append('images[]', image);
                        formdata.append('category','{{$category}}');
                        $.ajax({
                            url: '{{ url('') }}'+'/ajax/uploadImage.php',
                            data: formdata,
                            method: "POST",
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            success: function (res) {
                                res.forEach(function(x){
                                    x.url = x.url.substr(1);
                                    images.unshift(x);
                                })
                                $("#myUl").empty();
                                page = 1;
                                render();
                                document.body.scrollTop=0;

                            },
                            error:function(err){
                                alert('圖片上傳失敗，圖片名稱'+image.name);
                            }
                        });
                    }
                }


            }
        }
	@else
		$(".container")[0].ondrop = function (e) {
			e.preventDefault();
			$("#upload").css('opacity',0);
			alert('請先登入!');
			location.href = `{{ url('login') }}`;
		}
    @endif
        //取得目標
        var ul = document.querySelector('#myUl');
        var page = 1;
        var images = {!! json_encode($images) !!};

        //當畫面大小改變
        window.onresize = function () {
            //填滿圖片大小
            fullImage();
            //調整版面
            layout();

        }

        window.onscroll = function(){
            getData();
            fullImage();
        }

        function fullImage() {
            $("#upload").css({
                width:$(".container").width()+'px',
                height:$(".container").height() - $(".container>header").height() - Math.min(document.body.scrollTop,$(".container>header").height()) +'px',
                top: $(".container>header").height() - Math.min(document.body.scrollTop,$(".container>header").height())+'px',
            });
            var li = document.querySelectorAll('#myUl li');
            for (var i = 0; i < li.length; i++) {
                $(li[i]).height($(li[i].children[0]).data('height'));
                $(li[i].children[0]).height($(li[i].children[0]).data('height'));
            }
        }

        function getData() {
            var scrollTop = document.body.scrollTop;
            var scrollTotalHeight = document.body.scrollHeight;
            var windowHeight = document.body.clientHeight;;
            if (scrollTotalHeight <= scrollTop + windowHeight) {
                    render();
                }
            }

        function render(){
            $(".removeIcon").off('click');
            //先調整圖片大小
            fullImage();
            //if (page*10<images.length-1) {
                for (var i=(page-1)*15;i<Math.min(page*15,images.length);i++) {
                    var htmlStr = '';
                    htmlStr += '<li>';
                    htmlStr += '<img data-height='+images[i].height+' class="img-thumbnail" src="' + '{{ url('') }}'+ (images[i].url).substr(1) + '">';
                    @if (session()->has('name'))
                        htmlStr += '<span class="glyphicon glyphicon-remove removeIcon" va="'+i+'"></span>'
                    @endif
                    htmlStr += '</li>';
                    ul.innerHTML += htmlStr;
                    ul.lastChild.style.height = images[i].height + 'px';
                }
                page++;
                @if (session()->has('name'))
                    $(".removeIcon").on('click',function(){
                        var obj = $(this);
                        if(confirm('要刪除照片嗎?')){
                            var key = $(this).attr('va');
                            $.ajax({
                                url:'{{ url('') }}'+'/ajax/deleteFile.php',
                                method:"POST",
                                data:{
                                    url:'.'+images[key].url
                                },
                                success:function(res){
                                    images = images.removeAt(key);
                                    obj.parent().remove();
                                    if(images.length>0){
                                        fullImage();
                                        layout();
                                        $(".removeIcon").each(function(){
                                            var va = $(this).attr('va');
                                            if(va > key)
                                                $(this).attr('va',va - 1);
                                        });
                                    }
                                }
                            });
                        }
                    });
                @endif
                layout();
            //}
        }


        function layout() {
            if(images.length>0){
                //圖片最小的寬度
                var minWidth = 340;
                //紀錄高度的陣列
                var height = [];
                var li = document.querySelectorAll('#myUl li');
                //畫面寬度等於#myUl的寬度
                var mainWidth = ul.offsetWidth;
                //每個li的寬度都一樣，所以取第一個就好
                var liWidth = li[0].offsetWidth;
                //計算現在的版面一列可以塞下幾張圖
                var count = Math.floor(mainWidth / minWidth);
                //之後推算一個li的寬度可以多寬剛好填滿版面，至少不要留白太多(畫面小的情況下)
                var setLiWidth = Math.floor(mainWidth / count);
                for (var i = 0; i < li.length; i++) {
                    li[i].style.width = setLiWidth + 'px';
                    li[i].children[0].style.width = setLiWidth + 'px';
                    //第一列
                    if (i < count) {
                        li[i].style.left = setLiWidth * i + 'px';
                        li[i].style.top = 0 + 'px';
                        height[i] = li[i].offsetHeight;
                    } else {
                        //如果不是第一列就找出最小的高度往下疊
                        var min = Math.min.apply(null, height);
                        var index = height.indexOf(min);
                        li[i].style.left = index * setLiWidth + 'px';
                        li[i].style.top = height[index] + 'px';
                        height[index] += li[i].offsetHeight;
                    }

                }
                //把#myUl的高度設定的與li一樣高，最後底部的位置比較好定位。
                ul.style.height = Math.max.apply(null, height) + 'px';
                //如果到底部了
                if (document.querySelector("#bottom") != null)
                    document.querySelector("#bottom").style.top = Math.max.apply(null, height) + 'px';
            }
        }
        var adjust = setInterval(function(){
            var n = 0;
            $("#myUl li").each(function(){
                if($(this).height()>100){
                    n++;
                }
                if(n==$("#myUl li").length)
                {
                    fullImage();
                    layout();
                    clearInterval(adjust);
                    return false;
                }
            });
        },10);

        //DOM讀取完先取一次資料
        render();

</script>
@endsection
