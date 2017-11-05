@extends('pages.layout')

@section('title', '類別 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                <div class="list-group">
                    @foreach($categoryNav as $key => $val)
                        <a href="{{ URL_CATEGORY . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a>
                    @endforeach
                </div>

                <div class="list-group">
                    @foreach($seriesNav as $key => $val)
                        <a href="{{ URL_SERIES . '/' . $val->id }}" class="list-group-item">{{ $val->name }}</a>
                    @endforeach
                </div>
            </div>

            <div id="category-item-container" class="col-sm-9">
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
        </div>
    </div>

@endsection
