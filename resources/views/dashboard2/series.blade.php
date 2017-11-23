@extends('dashboard2.layout')
@inject('commonPresenter', 'App\Presenter\CommonPresenter')

@section('title', '系列管理 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('dashboard2.include.alert')

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">系列清單</h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary" onclick="seriesAdd(this);">新增</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="series-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>SN</th>
                            <th>系列名稱</th>
                            <th>display</th>
                            <th>顯示</th>
                            <th>描述</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($series as $key => $val)
                            <tr>
                                <td headers="id">{{ $val->id }}</td>
                                <td headers="sn">{{ 'SER' . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td headers="name">{{ $val->name }}</td>
                                <td headers="display">{{ $val->display }}</td>
                                <td>{{ $commonPresenter->yesNo($val->display) }}</td>
                                <td headers="desc">{{ $val->desc }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" onclick="seriesEdit(this);"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default" onclick="seriesDel(this);"><i class="fa fa-remove"></i></button>
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

    <form id="del-series" method="post" action="{{ URL_DASHBOARD2_SERIES_DO_DEL }}" style="display: none">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="">
    </form>

    <div id="edit-series" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">系列 編輯</h4>
                </div>
                <form role="form" method="post" action="{{ URL_DASHBOARD2_SERIES_DO_SAVE }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>SN.</label>
                            <input name="sn" disabled class="form-control">
                        </div>
                        <div class="form-group">
                            <label>系列名稱 (100)</label>
                            <input name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>顯示</label>
                            <select name="display" class="form-control">
                                <option value="Y">是</option>
                                <option value="N">否</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="desc" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('inner-js')
    <script>
        var seriesAdd = function(el) {
            // default
            $('#edit-series').find('form input[name="id"]').attr('value', '0');
            $('#edit-series').find('form input[name="sn"]').attr('value', '');
            $('#edit-series').find('form input[name="sn"]').parent().hide();
            document.querySelector('#edit-series form select[name="display"]').value = 'Y';
            $('#edit-series').find('form textarea[name="desc"]').text('');
            document.querySelector("#edit-series form").reset();
            $('#edit-series').modal('show');
        };
        var seriesEdit = function(el) {
            var rowTr = $(el).closest("tr");
            var seriesId = rowTr.find('td[headers="id"]').text();
            var seriesSn = rowTr.find('td[headers="sn"]').text();
            var seriesName = rowTr.find('td[headers="name"]').text();
            var seriesDisplay = rowTr.find('td[headers="display"]').text();
            var seriesDesc = rowTr.find('td[headers="desc"]').text();

            $('#edit-series').find('form input[name="id"]').attr('value', seriesId);
            $('#edit-series').find('form input[name="sn"]').attr('value', seriesSn);
            $('#edit-series').find('form input[name="name"]').attr('value', seriesName);
            $('#edit-series').find('form input[name="sn"]').parent().show();
            document.querySelector('#edit-series form select[name="display"]').value = seriesDisplay;
            $('#edit-series').find('form textarea[name="desc"]').text(seriesDesc);
            $('#edit-series').modal('show');
        };
        var seriesDel = function(el) {
            var rowTr = $(el).closest("tr");
            var seriesId = rowTr.find('td[headers="id"]').text();
            var seriesName = rowTr.find('td[headers="name"]').text();
            var message = '是否確認刪除 ' + seriesName;

            $('#del-series').find('input[name="id"]').val(seriesId);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };
        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#del-series').submit();
        });

        $(function () {
            $('#series-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0, 3], className: 'hide_column'},
                    {targets: [1], width: '50px'},
                    {targets: [6], width: '100px'}
                ]
            });
        })
    </script>
@endsection