@extends('dashboard2.layout')
@inject('commonPresenter', 'App\Presenter\CommonPresenter')

@section('title', '產品管理 | 日何百鐵')

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
                    <table id="category-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>SN</th>
                            <th>產品</th>
                            <th>副標題</th>
                            <th>長(cm)</th>
                            <th>寬(cm)</th>
                            <th>高(cm)</th>
                            <th>類別id</th>
                            <th>類別名稱</th>
                            <th>系列id</th>
                            <th>系列名稱</th>
                            <th>顯示</th>
                            <th>有效</th>
                            <th>內文</th>
                            <th width="100px">option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>{{ 'SN' . str_pad($val->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->subtitle }}</td>
                                <td>{{ $val->length }}</td>
                                <td>{{ $val->width }}</td>
                                <td>{{ $val->height }}</td>

                                <td>{{ $val->categoryLists[0]->category->id }}</td>
                                <td>{{ $val->categoryLists[0]->category->name }}</td>
                                <td>{{ $val->seriesLists[0]->series->id }}</td>
                                <td>{{ $val->seriesLists[0]->series->name }}</td>

                                <td>{{ $commonPresenter->YesNo($val->display) }}</td>
                                <td>{{ $commonPresenter->YesNo($val->active) }}</td>
                                <td>{{ $val->content }}</td>
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