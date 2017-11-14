@extends('dashboard2.layout')

@section('title', 'BANNER | 日何百鐵')

@section('inner-css')
    <style>
        #banner-table img{
            height: 50px;
        }
    </style>
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
                    <table id="banner-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Banner Url</th>
                            <th>Banner Image</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i=1; $i<=5; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                @if(isset($banner[$i]))
                                    <td>{{ $banner[$i]->value }}</td>
                                    <td><img src="{{ IMAGE_URL . $banner[$i]->value }}" /></td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-remove"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
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
            $('#banner-table').DataTable({
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