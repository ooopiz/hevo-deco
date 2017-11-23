@extends('pages.layout')

@section('title', '首頁 ｜日何百鐵')

@section('inner-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div id="home-slide" class="owl-carousel owl-theme">
            @if($banner->isEmpty())
                <div class="item">
                    <img src="http://placehold.it/1140x640">
                </div>
            @endif

            @foreach($banner as $key => $val)
                <div class="item">
                    <img src="{{ IMAGE_BANNER . $val->value }}">
                </div>
            @endforeach
        </div>
</div>

<div class="container">
        <div id="home-product-list">
            <div class="row">
                @if($news->isEmpty())
                    @for($i=1; $i<=6; $i++)
                        <div class="col-md-4 product-item">
                            <img src="http://placehold.it/340x340">
                            <h4>0000-00-00</h4>
                            <p>Description............</p>
                        </div>
                    @endfor
                @endif

                @foreach($news as $key => $val)
                    <div class="col-md-4 product-item">
                        <img src="{{ IMAGE_NEWS . $val->image_url }}">
                        <h4>{{ substr($val->created_at , 0 , 10) }}</h4>
                        <p>{{ $val->desc }}</p>
                    </div>
                @endforeach
            </div>
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
        });
     
        //顯示當前頁 ok
        document.getElementById('nav-1').style.borderBottom = "0.4rem solid #b0bec5";

           
        //固定頂層導覽列 失效待修
        $(function() {　
            $(window).load(function() {　　
                $(window).bind('scroll resize', function() {　　
                    var $this = $(this);　　
                    var $this_Top = $this.scrollTop();

                    if ($this_Top > 150) {
                        $('#nav-main').addClass('top-bar');
                        $('#nav-main').stop().animate({
                            top: "20px"
                        });　　　
                    }　　　　
                    if ($this_Top < 150) {
                        $('#nav-main').removeClass('top-bar');
                        $('#nav-main').stop().animate({
                            top: "0px"
                        });　　　
                    }　　
                }).scroll();　
            });
        });
        
    </script>
@endsection
