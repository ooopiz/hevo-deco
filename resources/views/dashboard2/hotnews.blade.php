@extends('dashboard2.layout')

@section('title', '最新消息 | 日何百鐵')

@section('inner-css')
    <style>
        #news-table img {
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
                    <table id="news-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>No</th>
                            <th>News Url</th>
                            <th>News Image</th>
                            <th width="100px">option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($hotNews as $key => $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $val->desc }}</td>
                                <td>
                                    <img src="{{ IMAGE_URL . $val->image_url }}" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-default"><i class="fa fa-remove"></i></button>
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
@endsection