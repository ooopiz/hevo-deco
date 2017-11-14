@extends('dashboard2.layout')
@inject('commonPresenter', 'App\Presenter\CommonPresenter')

@section('title', '系列管理 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hover Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="series-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>SN</th>
                            <th>系列名稱</th>
                            <th>顯示</th>
                            <th>描述</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($series as $key => $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ 'SER' . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $commonPresenter->yesNo($val->display) }}</td>
                                <td>{{ $val->desc }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-remove"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection

@section('inner-js')
    <script>
        $(function () {
            $('#series-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
        })
    </script>
@endsection