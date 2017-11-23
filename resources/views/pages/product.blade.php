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
@section('inner-js')
<script>
    document.getElementById('nav-2').style.borderBottom = "0.4rem solid #b0bec5";
</script>
@endsection 
@endsection