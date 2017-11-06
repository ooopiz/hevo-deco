@extends('pages.layout')

@section('title', '系列 ｜日何百鐵')

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

            <div id="series-item-container" class="col-sm-9">
                <div class="row">
                    @foreach($series->seriesList as $serList)
                        <div class="col-sm-6 item">
                            <a href="{{ URL_PRODUCT . '/' . $serList->product->id }}">
                                @if($serList->product->materialImages->count() == 0)
                                    <img class="img-thumbnail" src='http://placehold.it/410x350' />
                                @elseif($serList->product->materialImages->count() == 1)
                                    <img class="img-thumbnail" src='{{ IMAGE_URL . $serList->product->materialImages[0]->image_url }}' />
                                @else
                                    <img class="img-thumbnail"
                                         src='{{ IMAGE_URL . $serList->product->materialImages[0]->image_url }}'
                                         onmouseout="this.src='{{ IMAGE_URL . $serList->product->materialImages[0]->image_url }}';"
                                         onmouseover="this.src='{{ IMAGE_URL . $serList->product->materialImages[1]->image_url }}';" />
                                @endif
                                <h4>{{ $serList->product->name }}</h4>
                            </a>
                            <p>{{ $serList->product->subtitle }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
