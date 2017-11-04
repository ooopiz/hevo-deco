@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        系列管理
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <button id="series-add" type="button" class="btn btn-primary">新增</button>

            <div class="row">
                <div id="series-list" class="col-lg-6">
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>系列名稱</th>
                                <th>顯示</th>
                                <th>備註</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($series as $key => $val)
                                <tr>
                                    <td headers="series_id" style="display: none;">{{ $val->id }}</td>
                                    <td headers="series_sn">{{ $siteVar['sn_prefix'] . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td headers="series_name">{{ $val->name }}</td>
                                    <td headers="series_display">{{ $val->display }}</td>
                                    <td headers="series_desc">{{ $val->desc }}</td>
                                    <td style="width: 80px; text-align: center">
                                        <button series-id="{{ $val->id }}" type="button" class="btn btn-xs btn-danger series-delete">刪除</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="series-edit" class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_SERIES_DO_EDIT }}" style="display: none;">
                        <div class="form-group" style="display: none">
                            <label>ID</label>
                            <input name="series_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>SN.</label>
                            <input name="series_sn" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label>系列名稱 (100)</label>
                            <input name="series_name" class="form-control" required="required">
                        </div>

                        <div class="form-group">
                            <label>顯示</label>
                            <select name="series_display" class="form-control">
                                <option value="Y">是</option>
                                <option value="N">否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="series_desc" class="form-control" rows="3"></textarea>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="text-center form-button">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection

@section('inner-js')
    <script>
        // DOCUMENT READY
        function eventHandler() {

            // Highlight selected bar
            $('#series-list table tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                // edit
                var seriesId = this.querySelector('[headers="series_id"]').textContent;
                var seriesSN = this.querySelector('[headers="series_sn"]').textContent;
                var seriesName = this.querySelector('[headers="series_name"]').textContent;
                var seriesDisplay = this.querySelector('[headers="series_display"]').textContent;
                var seriesDesc = this.querySelector('[headers="series_desc"]').textContent;

                // show news editer
                $('#series-edit form').show();
                $('#series-edit form input[name="series_id"]').attr('value', seriesId);
                $('#series-edit form input[name="series_sn"]').attr('value', seriesSN.trim());
                $('#series-edit form input[name="series_sn"]').parent().show();
                $('#series-edit form input[name="series_name"]').attr('value', seriesName);
                document.querySelector('#series-edit form select[name="series_display"]').value = seriesDisplay;
                $('#series-edit form textarea[name="series_desc"]').text(seriesDesc);
            });

            // news add click
            var seriesAdd = document.querySelector('#series-add');
            seriesAdd.addEventListener('click', function (event) {
                $('#series-edit form').show();
                $('#series-edit form input[name="series_id"]').attr('value', '');
                $('#series-edit form input[name="series_sn"]').attr('value', '');
                $('#series-edit form input[name="series_sn"]').parent().hide();
                $('#series-edit form input[name="series_name"]').attr('value', '');
                document.querySelector('#series-edit form select[name="series_display"]').value = 'Y';
                $('#series-edit form textarea[name="series_desc"]').text('');
                document.querySelector("#series-edit form").reset();
            });

            // news del click
            var seriesDel = document.querySelectorAll('.series-delete');
            for (var i = 0; i < seriesDel.length; i++) {
                seriesDel[i].addEventListener('click', function(event) {
                    if (confirm('確認刪除?')) {
                        var newsId = this.getAttribute("series-id");
                        var params = {
                            "series_id" : newsId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_SERIES_DO_DELETE }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                window.location.replace('{{ URL_DASHBOARD_SERIES }}');
                            } else {
                                alert(data.message);
                            }
                        });
                    }
                });
            }
        }
        if (document.readyState === 'complete' || document.readyState !== 'loading') {
            eventHandler();
        } else {
            document.addEventListener('DOMContentLoaded', eventHandler);
        }
    </script>
@endsection