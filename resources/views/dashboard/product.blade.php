@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        產品管理
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <button type="button" class="btn btn-primary" onclick="location.href='{{ URL_DASHBOARD_PRODUCT_EDIT }}';">新增</button>

            <div class="row">
                <div class="col-lg-6">
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>產品名稱</th>
                                <th>類別</th>
                                <th>系列</th>
                                <th>顯示</th>
                                <th>有效</th>
                                <th>備註</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $val)
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-link" onclick="location.href='{{ URL_DASHBOARD_PRODUCT_EDIT . '/' . $val->id }}';">
                                            {{ $siteVar['sn_prefix'] . str_pad($val->id, 5, '0', STR_PAD_LEFT) }}
                                        </button>
                                    </td>
                                    <td>{{ $val->name }}</td>
                                    <td>
                                        @foreach($val->categoryLists as $ser_key => $ser_val)
                                            {{ $ser_val->category->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($val->seriesLists as $ser_key => $ser_val)
                                            {{ $ser_val->series->name }}
                                        @endforeach
                                    </td>
                                    <td>{{ $val->display }}</td>
                                    <td>{{ $val->active }}</td>
                                    <td>{{ $val->desc }}</td>
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
