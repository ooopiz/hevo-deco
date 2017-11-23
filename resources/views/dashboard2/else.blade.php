@extends('dashboard2.layout')

@section('title', '其他設定 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('dashboard2.include.alert')

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                    <form method="post" action="{{ URL_DASHBOARD2_ELSE_DO_UPDATE }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="update-code" type="submit" class="btn btn-primary">程式更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('inner-js')
@endsection