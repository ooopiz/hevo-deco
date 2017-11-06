@extends('pages.layout')

@section('title', '產品 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-3">
            <div class="list-group">
                @foreach($categories as $key => $val)
                    <a href="{{ URL_CATEGORY . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a>
                @endforeach
            </div>

            <div class="list-group">
                @foreach($series as $key => $val)
                    <a href="{{ URL_SERIES . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a>
                @endforeach
            </div>
        </div>

        <div id="product-item-container" class="col-sm-9">
            @foreach($categories as $key => $cat)
                @if($cat->categoryList->isNotEmpty())
                    <div class="row">
                        @foreach($cat->categoryList as $catList)
                            <div class="col-sm-6 item">
                                <a href="{{ URL_PRODUCT . '/' . $catList->product->id }}">
                                @if($catList->product->materialImages->count() == 0)
                                    <img class="img-thumbnail" src='http://placehold.it/410x350' />
                                @elseif($catList->product->materialImages->count() == 1)
                                    <img class="img-thumbnail" src='{{ IMAGE_URL . $catList->product->materialImages[0]->image_url }}' />
                                @else
                                    <img class="img-thumbnail"
                                         src='{{ IMAGE_URL . $catList->product->materialImages[0]->image_url }}'
                                         onmouseout="this.src='{{ IMAGE_URL . $catList->product->materialImages[0]->image_url }}';"
                                         onmouseover="this.src='{{ IMAGE_URL . $catList->product->materialImages[1]->image_url }}';" />
                                @endif

                                <h4>{{ $catList->product->name }}</h4>
                                </a>
                                <p>{{ $catList->product->subtitle }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

        </div>
    </div>

</div>

@endsection
