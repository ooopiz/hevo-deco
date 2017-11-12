<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>登入</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/sb-admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/sb-admin/css/sb-admin.css') }}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{ asset('/sb-admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        body {
            font-family: Raleway,sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #636b6f;
        }
        .panel-default {
            border-color: #d3e0e9;
        }
        .panel-default .panel-heading {
            color: #333;
            background-color: #fff;
            border-color: #d3e0e9;
        }
        .panel-body {
            padding: 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            text-align: right;
            margin-bottom: 0;
            padding-top: 7px;
        }
        .btn-login {
            color: #fff;
            background-color: #3097D1;
            border-color: #2a88bd;
        }
        .btn-login:hover {
            color: #fff;
            background-color: #2579a9;
            border-color: #1f648b;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ URL_USER_DO_LOGIN }}" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Account</label>
                                <div class="col-md-6">
                                    <input class="form-control" placeholder="E-Mail" name="email" type="email" autofocus required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input class="btn btn-block btn-login" type="submit" value="Login">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('/sb-admin/js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/sb-admin/js/bootstrap.min.js') }}"></script>
</body>

</html>
