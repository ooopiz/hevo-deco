@extends('pages.layout')

@section('title', '產品 ｜日何百鐵')

@section('inner-css')
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                {{--<div class="list-group">--}}
                    {{--@foreach($categories as $key => $val)--}}
                        {{--<a href="#" class="list-group-item">{{ $val->name  }}</a>--}}
                    {{--@endforeach--}}
                {{--</div>--}}

                {{--<div class="list-group">--}}
                    {{--@foreach($series as $key => $val)--}}
                        {{--<a href="#" class="list-group-item">{{ $val->name  }}</a>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            </div>


        </div>

    </div>

@endsection
