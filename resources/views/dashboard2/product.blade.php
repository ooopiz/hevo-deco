@extends('dashboard2.layout')
@inject('commonPresenter', 'App\Presenter\CommonPresenter')

@section('title', '產品管理 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('dashboard2.include.alert')

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">產品列表</h3>

                    <div class="pull-right box-tools">
                        <a href="{{ URL_DASHBOARD2_PRODUCT_NEW }}">
                            <button type="button" class="btn btn-primary">新增</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="product-table" class="table table-bordered table-hover">
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
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $val)
                            <tr>
                                <td headers="id">{{ $val->id }}</td>
                                <td>{{ 'SN' . str_pad($val->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td headers="name">{{ $val->name }}</td>
                                <td>{{ $val->subtitle }}</td>
                                <td>{{ $val->length }}</td>
                                <td>{{ $val->width }}</td>
                                <td>{{ $val->height }}</td>

                                <td>{{ $val->categoryLists[0]->category->id }}</td>
                                <td>{{ $val->categoryLists[0]->category->name }}</td>
                                <td>{{ $val->seriesLists[0]->series->id }}</td>
                                <td>{{ $val->seriesLists[0]->series->name }}</td>

                                <td>{{ $commonPresenter->yesNo($val->display) }}</td>
                                <td>{{ $commonPresenter->yesNo($val->active) }}</td>
                                <td>{{ $val->content }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" onclick="javascript:location.href='{{ URL_DASHBOARD2_PRODUCT . '/' . $val->id }}';"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default" onclick="productDel(this);"><i class="fa fa-remove"></i></button>
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

    <form id="del-product" method="post" action="{{ URL_DASHBOARD2_PRODUCT_DO_DEL }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="">
    </form>

@endsection

@section('inner-js')
    <script>
        var productDel = function(el) {
            var rowTr = $(el).closest("tr");
            var productId = rowTr.find('td[headers="id"]').text();
            var productName = rowTr.find('td[headers="name"]').text();
            var message = '是否確認刪除 ' + productName;

            $('#del-product').find('input[name="id"]').val(productId);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };

        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#del-product').submit();
        });

        $(function () {
            $('#product-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0], className: 'hide_column'},
                    {targets: [1], width: '50px'},
                    {targets: [7,9], className: 'hide_column'},
                    {targets: [13], width: '100px'}
                ]
            });
        })
    </script>
@endsection