<div id="slideShow">
    @foreach ($images as $image)
    <img src="{{url($image)}}"> @endforeach

</div>
<script>
    $("#slideShow img").first().addClass('active');
        $(window).resize(function(){
            layout()
        });
        function layout(){
            var index = $("#slideShow img.active").index();
            var width = $('#slideShow img').width();
            for(var i = 0 ; i<$("#slideShow img").length ;i++){
                var n = Math.abs(i-index);
                $("#slideShow img").eq(i).css('left',width * n + 'px');
            }
        }
        var isSlideShowEnd = true;
        var slideShow = setInterval(function(){
            if(isSlideShowEnd){
                isSlideShowEnd = false;
                var index = $("#slideShow img.active").index();
                $("#slideShow img").removeClass('active');
                $("#slideShow img").eq(index+1).addClass('active');
                var move = setInterval(function(){
                    var $img = $("#slideShow img")
                    var oldLeft = parseInt($img.eq(index).css('left'));
                    var currentLeft = parseInt($img.eq(index+1).css('left'));
                    if(currentLeft>10){
                        $img.eq(index).css('left',oldLeft-10 + 'px');
                        $img.eq(index+1).css('left',currentLeft-10 + 'px');
                    }else{
                        $img.eq(index).css('left',oldLeft-currentLeft + 'px');
                        $img.eq(index+1).css('left','0px');
                        $img.eq(index).appendTo($("#slideShow"));
                        layout();
                        isSlideShowEnd = true;
                        clearInterval(move);
                        return;
                    }
                },5);
            }
        },5000);

        layout();

</script>
