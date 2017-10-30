@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        材質管理
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <button type="button" class="btn btn-primary" onclick="location.href='{{ URL_DASHBOARD_MATERIAL_EDIT }}';">新增</button>

            <div class="row">
                <div class="col-lg-6">
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>材質名稱</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($materials as $key => $val)
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-link" onclick="location.href='{{ URL_DASHBOARD_MATERIAL_EDIT . '/' . $val->id }}';">
                                            {{ $siteVar['sn_prefix'] . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}
                                        </button>
                                    </td>
                                    <td>{{ $val->name }}</td>
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