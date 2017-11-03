@extends('pages.layout')

@section('title', '產品詳細 ｜日何百鐵')

@section('inner-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.min.css">
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-xs-6">
                <div class="owl-carousel owl-theme">
                    @if($product->materialImages->count() == 0)
                        <img class="img-thumbnail" src="http://placehold.it/500x500">
                    @endif
                    @foreach($product->materialImages as $val)
                        <img class="img-thumbnail" src="{{ IMAGE_URL . $val->image_url }}">
                    @endforeach
                </div>
            </div>
            <div class="col-xs-6">
                <h1>{{ $product->name }}</h1>
                <h3>{{ $product->subtitle }}</h3>
                <p>{{ $product->content }}</p>
                <p>長 : {{ $product->length }}</p>
                <p>寬 : {{ $product->width }}</p>
                <p>高 : {{ $product->height }}</p>
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
        })
    </script>
@endsection