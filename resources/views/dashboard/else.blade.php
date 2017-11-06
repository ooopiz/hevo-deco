@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        其它
                    </h1>
                </div>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-info">
                    {{ session()->get('message') }}
                </div>
            @endif

            <form method="post" action="{{ URL_DASHBOARD_ELSE_DO_UPDATE }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button id="update-code" type="submit" class="btn btn-primary">程式更新</button>
            </form>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection

@section('inner-js')
@endsection