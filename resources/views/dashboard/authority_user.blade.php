@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        用戶管理
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <button type="button" class="btn btn-primary" onclick="location.href='{{ URL_DASHBOARD_AUTHORITY_PRODUCT_EDIT }}';">新增管理員</button>

            <div class="row">
                <div class="col-lg-6">
                    <h2>Title__</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>名稱</th>
                                <th>信箱</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $val)
                                <tr>
                                    <td>{{ $val->name }}</td>
                                    <td>{{ $val->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection
