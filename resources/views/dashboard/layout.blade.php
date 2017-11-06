<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="{{ asset('/sb-admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.css" />
    <link href="{{ asset('/sb-admin/css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/sb-admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet" type="text/css">

@yield('inner-css')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">日何百鐵</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ $loginUser->name or '---' }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ URL_DASHBOARD_PROFILE }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL_USER_LOGOUT }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- nav left -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#system" class="" aria-expanded="true">
                            <i class="fa fa-fw fa-anchor"></i>
                            網站設定
                            <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="system" class="collapse in" aria-expanded="true">
                            <li>
                                <a href="{{ URL_DASHBOARD_BANNER }}"><i class="fa fa-fw fa-exchange"></i>Banner</a>
                            </li>
                            <li>
                                <a href="{{ URL_DASHBOARD_HOTNEWS }}"><i class="fa fa-fw fa-newspaper-o"></i>最新消息</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ URL_DASHBOARD_CATEGORY }}"><i class="fa fa-fw fa-bookmark"></i>類別管理</a>
                    </li>
                    <li>
                        <a href="{{ URL_DASHBOARD_SERIES }}"><i class="fa fa-fw fa-tag"></i>系列管理</a>
                    </li>
                    <li>
                        <a href="{{ URL_DASHBOARD_MATERIAL }}"><i class="fa fa-fw fa-eyedropper"></i>材質管理</a>
                    </li>
                    <li>
                        <a href="{{ URL_DASHBOARD_PRODUCT }}"><i class="fa fa-fw fa-pencil"></i>產品管理</a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="{{ URL_DASHBOARD_AUTHORITY_PRODUCT }}"><i class="fa fa-fw fa-dashboard"></i>權限管理</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{ URL_DASHBOARD_ELSE }}"><i class="fa fa-fw fa-cogs"></i>其它</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

@yield('content')

    </div>
    <!-- /#wrapper -->

    {{--<script src="{{ asset('/sb-admin/js/jquery.js') }}"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('/sb-admin/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>

@yield('inner-js')

</body>

</html>
