<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/dist/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/dist/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/adminlte/css/adminlte.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/dist/adminlte/css/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="/dist/datatables.net/dataTables.bootstrap.min.css">

    <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/dashboard2.css') }}" rel="stylesheet" type="text/css">
    @yield('inner-css')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>H</b>evo</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>HEVO</b>deco</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            {{--<img src="/dist/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">Admin</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            {{--<li class="user-header">--}}
                                {{--<img src="/dist/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                                {{--<p>--}}
                                    {{--Alexander Pierce - Web Developer--}}
                                    {{--<small>Member since Nov. 2012</small>--}}
                                {{--</p>--}}
                            {{--</li>--}}
                            {{--<!-- Menu Body -->--}}
                            {{--<li class="user-body">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-xs-4 text-center">--}}
                                        {{--<a href="#">Followers</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-4 text-center">--}}
                                        {{--<a href="#">Sales</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-xs-4 text-center">--}}
                                        {{--<a href="#">Friends</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- /.row -->--}}
                            {{--</li>--}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ URL_DASHBOARD2_PROFILE }}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ URL_USER_LOGOUT }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="treeview active">
                    <a href="#"><i class="fa fa-link"></i> <span>網站設定</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ URL_DASHBOARD2_BANNER }}"><i class="fa fa-link"></i> <span>Banner</span></a></li>
                        <li><a href="{{ URL_DASHBOARD2_HOTNEWS }}"><i class="fa fa-link"></i> <span>最新消息</span></a></li>
                        <li><a href="{{ URL_DASHBOARD2_ELSE }}"><i class="fa fa-link"></i> <span>其它</span></a></li>
                    </ul>
                </li>
                {{--<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Index</span></a></li>--}}
                <li><a href="{{ URL_DASHBOARD2_CATEGORY }}"><i class="fa fa-link"></i> <span>類別管理</span></a></li>
                <li><a href="{{ URL_DASHBOARD2_SERIES }}"><i class="fa fa-link"></i> <span>系列管理</span></a></li>
                <li><a href="{{ URL_DASHBOARD2_MATERIAL }}"><i class="fa fa-link"></i> <span>材質管理</span></a></li>
                <li><a href="{{ URL_DASHBOARD2_PRODUCT }}"><i class="fa fa-link"></i> <span>產品管理</span></a></li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--<section class="content-header">--}}
            {{--<h1>--}}
                {{--Page Header--}}
                {{--<small>Optional description</small>--}}
            {{--</h1>--}}
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
                {{--<li class="active">Here</li>--}}
            {{--</ol>--}}
        {{--</section>--}}

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            @yield('content')

            @include('dashboard2.include.modal')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 <a href="//www.hevodeco.com" target="_blank">Hevo-deco</a>.</strong> All rights reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/dist/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/dist/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/adminlte/js/adminlte.min.js"></script>

<script src="/dist/datatables.net/jquery.dataTables.min.js"></script>
<script src="/dist/datatables.net/dataTables.bootstrap.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script src="{{ asset('/js/dropzone.min.js') }}"></script>
<script src="{{ asset('/js/fileUploadInput.js') }}"></script>
@yield('inner-js')
</body>
</html>