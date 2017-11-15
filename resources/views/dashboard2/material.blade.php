@extends('dashboard2.layout')

@section('title', '材質管理 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">材質列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="material-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>SN</th>
                            <th>材質名稱</th>
                            <th>描述</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $key => $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ 'MAT' . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $val->name }}</td>
                                <td></td>
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
            $('#material-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0], className: 'hide_column'},
                    {targets: [1], width: '50px'},
                    {targets: [4], width: '100px'}
                ]
            });
        })
    </script>
@endsection