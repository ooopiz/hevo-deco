@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        設定
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    @if(isset($result))
                        <div class="alert {{ $result['css'] }}">
                            <strong>{{ $result['message'] }}</strong>
                        </div>
                    @endif


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">修改密碼</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="{{ URL_DASHBOARD_PROFILE }}" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Password</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="Password" name="password" type="Password" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input class="form-control" placeholder="RePassword" name="repassword" type="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <input class="btn btn-block btn-login" type="submit" value="存檔">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
