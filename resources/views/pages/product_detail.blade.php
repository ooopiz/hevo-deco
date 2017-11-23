@extends('pages.layout')

@section('title', '產品詳細 ｜日何百鐵')

@section('inner-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-2">
                <div class="list-group product-types">
                    @foreach($categoryNav as $key => $val)
                        <a href="{{ URL_CATEGORY . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a>
                    @endforeach
                </div>
                
                <hr class="divide-line">

                <div class="list-group product-types">
                    @foreach($seriesNav as $key => $val)
                        <a href="{{ URL_SERIES . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-7">
                <div class="owl-carousel owl-theme">
                    @if($product->materialImages->count() == 0)
                        <img class="img-thumbnail" src="http://placehold.it/500x500">
                    @endif
                    @foreach($product->materialImages as $val)
                        <img class="img-thumbnail" src="{{ IMAGE_PRODUCT . $val->image_url }}">
                    @endforeach
                </div>
            </div>
            <div class="col-sm-3 product-intro">
                <h1><b>{{ $product->name }}</b></h1>
                <h3>{{ $product->subtitle }}</h3>
                <p>{{ $product->content }}</p>

                <div class="textures fade-in">
                    @foreach($product->materialLists as $matList)
                        <a><img src="{{ IMAGE_MATERIAL . $matList->material->image_url }}"></a>
                    @endforeach
                </div>
                <div class="dimensions">
                    <p>長：<span>{{ $product->length }}cm</span></p>
                    <p>寬：<span>{{ $product->width }}cm</span></p>
                    <P>高：<span>{{ $product->height }}cm</span></P>
                    <span>&#9998;</span>
                </div>
                <div class="info-customize fade-in">
                    <p>可接受訂製, 請直接聯繫我們告知需求</p>
                </div>

                <button><a href="http://udesign.udnfunlife.com/mall/cus/cat/Cc1c01.do?dc_cateid_0=0_059_049_391&eventpage=202712311&kdid=eventPage">前往購買 / 訂購</a></button>
            </div>
        </div>

        <div id="product-else" class="row">
            <h3>其他產品</h3>
            @foreach($similarProduct as $catList)
                <div class="col-xs-4">
                    <h5>{{ $catList->product->name }}</h5>

                    <a href="{{ URL_PRODUCT . '/' . $catList->product->id }}">
                        @if($catList->product->materialImages->count() == 0)
                            <img class="img-thumbnail" src='http://placehold.it/400x400' />
                        @elseif($catList->product->materialImages->count() >= 1)
                            <img class="img-thumbnail" src='{{ IMAGE_PRODUCT . $catList->product->materialImages[0]->image_url }}' />
                        @endif
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection

@section('inner-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            autoplay: true,
            loop:true,
            margin:10,
            responsive:{ 0:{ items:1 } }
        })
    </script>
@endsection