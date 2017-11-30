@extends('pages.layout') @section('title', '產品 ｜日何百鐵') @section('inner-css') @endsection @section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-2">
            <div class="list-group product-types">
                @foreach($categories as $key => $val)
                <a href="{{ URL_CATEGORY . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a> @endforeach
            </div>

            <hr class="divide-line">

            <div class="list-group product-types">
                @foreach($series as $key => $val)
                <a href="{{ URL_SERIES . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a> @endforeach
            </div>
        </div>

        <div id="product-item-container" class="col-sm-10">
            @foreach($categories as $key => $cat) @if($cat->categoryList->isNotEmpty())
            <div class="row">
                @foreach($cat->categoryList as $catList)
                <div class="col-sm-6 item">
                    <a href="{{ URL_PRODUCT . '/' . $catList->product->id }}">
                                @if($catList->product->materialImages->count() == 0)
                                    <img class="img-thumbnail" src='http://placehold.it/400x400' />
                                @elseif($catList->product->materialImages->count() == 1)
                                    <img class="img-thumbnail" src='{{ IMAGE_PRODUCT . $catList->product->materialImages[0]->image_url }}' />
                                @else
                                    <img class="img-thumbnail"
                                         src='{{ IMAGE_PRODUCT . $catList->product->materialImages[0]->image_url }}'
                                         onmouseout="this.src='{{ IMAGE_PRODUCT . $catList->product->materialImages[0]->image_url }}';"
                                         onmouseover="this.src='{{ IMAGE_PRODUCT . $catList->product->materialImages[1]->image_url }}';" />
                                @endif

                                <h4>{{ $catList->product->name }}</h4>
                                </a>
                    <p>{{ $catList->product->subtitle }}</p>
                </div>
                @endforeach
            </div>
            @endif @endforeach

        </div>
    </div>
</div>

<a onclick="popUpChatBox()" class="chat-trigger">ϟ 聯絡百鐵</a>

<div id="chat-box">
    <div onclick="closeChatBox()" class="btn-close"><span>▾</span></div>
    <div class="fb-page" data-href="https://www.facebook.com/hevodeco/" data-tabs="messages" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
        <blockquote cite="https://www.facebook.com/hevodeco/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/hevodeco/">Hevo 日何百鐵</a></blockquote>
    </div>
</div>

@section('inner-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    //固定頂層導覽列
    $(function() {　
        $(window).load(function() {　　
            $(window).bind('scroll resize', function() {　　
                var $this = $(this);　　
                var $this_Top = $this.scrollTop();

                if ($this_Top > 250) {
                    $('#nav-main').addClass('top-bar');
                    $('#nav-main').stop().animate({
                        top: "20px"
                    });　　　
                }　　　　
                if ($this_Top < 250) {
                    $('#nav-main').removeClass('top-bar');
                    $('#nav-main').stop().animate({
                        top: "0px"
                    });　　　
                }　　
            }).scroll();　
        });
    });

    //add <link> in head
    var head = document.getElementsByTagName('head')[0],
        conURL = 'http://www.hevodeco.com/product',
        linkTag = document.createElement('link');


    linkTag.setAttribute('rel', 'canonical');
    linkTag.href = conURL;
    

    head.appendChild(linkTag);
    
    //show now
    document.getElementById('nav-2').style.borderBottom = "0.4rem solid #b0bec5";

    
    //fb-messenger box
    function popUpChatBox() {
        document.getElementById('chat-box').style.display = "inline-block";
    }

    function closeChatBox() {
        document.getElementById('chat-box').style.display = "none";
    }
</script>
@endsection @endsection