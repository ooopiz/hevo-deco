@extends('dashboard2.layout')

@section('title', 'Profile |日何百鐵')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @include('dashboard2.include.alert')
            @include('dashboard2.include.validate')

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">修改密碼</h3>
                </div>
                <form method="post" action="{{ URL_DASHBOARD2_PROFILE_DO_PASSWORD_RESET }}" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Password</label>

                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Password" name="password" type="Password" autofocus required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Confirm Password</label>

                            <div class="col-sm-6">
                                <input class="form-control" placeholder="Confirm Password" name="password_confirmation" type="password" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-footer text-center">
                        <button type="submit" class="btn btn-info">存檔</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
