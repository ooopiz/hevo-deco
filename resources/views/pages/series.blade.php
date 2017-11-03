@extends('pages.layout')

@section('title', '系列 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')
    <div class="container">

        <div class="item-header">
            <h3>{{ $series->name }}</h3>
        </div>

        @if($series->seriesList->isEmpty())
            沒有資料
        @endif
        <div class="row">
            @foreach($series->seriesList as $serList)
                <div class="col-sm-4">
                    {{ $serList->product->name }}

                    @if($serList->product->materialImages->count() == 0)
                        <img class="img-thumbnail" src='http://placehold.it/400x400' />
                    @elseif($serList->product->materialImages->count() == 1)
                        <img class="img-thumbnail" src='{{ IMAGE_URL . $serList->product->materialImages[0]->image_url }}' />
                    @else
                        <img class="img-thumbnail"
                             src='{{ IMAGE_URL . $serList->product->materialImages[0]->image_url }}'
                             onmouseout="this.src='{{ IMAGE_URL . $serList->product->materialImages[0]->image_url }}';"
                             onmouseover="this.src='{{ IMAGE_URL . $serList->product->materialImages[1]->image_url }}';" />
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@endsection
