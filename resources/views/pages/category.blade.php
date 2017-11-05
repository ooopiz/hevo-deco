@extends('pages.layout')

@section('title', '類別 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')
    <div class="container">

        <div class="item-header">
            <h3>{{ $category->name }}</h3>
        </div>

        @if($category->categoryList->isEmpty())
            沒有資料
        @endif
        <div class="row">
            @foreach($category->categoryList as $catList)
                <div class="col-sm-4">
                    {{ $catList->product->name }}

                    <a href="{{ URL_PRODUCT . '/' . $catList->product->id }}">
                    @if($catList->product->materialImages->count() == 0)
                        <img class="img-thumbnail" src='http://placehold.it/400x400' />
                    @elseif($catList->product->materialImages->count() == 1)
                        <img class="img-thumbnail" src='{{ IMAGE_URL . $catList->product->materialImages[0]->image_url }}' />
                    @else
                        <img class="img-thumbnail"
                             src='{{ IMAGE_URL . $catList->product->materialImages[0]->image_url }}'
                             onmouseout="this.src='{{ IMAGE_URL . $catList->product->materialImages[0]->image_url }}';"
                             onmouseover="this.src='{{ IMAGE_URL . $catList->product->materialImages[1]->image_url }}';" />
                    @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
