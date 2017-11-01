@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        類別管理
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <button id="category-add" type="button" class="btn btn-primary">新增</button>

            <div class="row">
                <div id="category-list" class="col-lg-6">
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>類別名稱</th>
                                <th>顯示</th>
                                <th>備註</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $val)
                                <tr>
                                    <td headers="category_id" style="display: none;">{{ $val->id }}</td>
                                    <td headers="category_sn">{{ $siteVar['sn_prefix'] . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td headers="category_name">{{ $val->name }}</td>
                                    <td headers="category_display">{{ $val->display }}</td>
                                    <td headers="category_desc">{{ $val->desc }}</td>
                                    <td style="width: 80px; text-align: center">
                                        <button category-id="{{ $val->id }}" type="button" class="btn btn-xs btn-danger category-delete">刪除</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="category-edit" class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_CATEGORY_DO_EDIT }}" style="display: none;">
                        <div class="form-group" style="display: none">
                            <label>ID</label>
                            <input name="category_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>SN.</label>
                            <input name="category_sn" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label>類別名稱 (100)</label>
                            <input name="category_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>顯示</label>
                            <select name="category_display" class="form-control">
                                <option value="Y">是</option>
                                <option value="N">否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="category_desc" class="form-control" rows="3"></textarea>
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
            $('#category-list table tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                // edit
                var categoryId = this.querySelector('[headers="category_id"]').textContent;
                var categorySN = this.querySelector('[headers="category_sn"]').textContent;
                var categoryName = this.querySelector('[headers="category_name"]').textContent;
                var categoryDisplay = this.querySelector('[headers="category_display"]').textContent;
                var categoryDesc = this.querySelector('[headers="category_desc"]').textContent;

                // show news editer
                $('#category-edit form').show();
                $('#category-edit form input[name="category_id"]').attr('value', categoryId);
                $('#category-edit form input[name="category_sn"]').attr('value', categorySN.trim());
                $('#category-edit form input[name="category_sn"]').parent().show();
                $('#category-edit form input[name="category_name"]').attr('value', categoryName);
                document.querySelector('#category-edit form select[name="category_display"]').value = categoryDisplay;
                $('#category-edit form textarea[name="category_desc"]').text(categoryDesc);
            });

            // news add click
            var hotNewsAdd = document.querySelector('#category-add');
            hotNewsAdd.addEventListener('click', function (event) {
                $('#category-edit form').show();
                $('#category-edit form input[name="category_id"]').attr('value', '');
                $('#category-edit form input[name="category_sn"]').attr('value', '');
                $('#category-edit form input[name="category_sn"]').parent().hide();
                $('#category-edit form input[name="category_name"]').attr('value', '');
                document.querySelector('#category-edit form select[name="category_display"]').value = 'Y';
                $('#category-edit form textarea[name="category_desc"]').text('');
                document.querySelector("#category-edit form").reset();
            });

            // news del click
            var categoryDel = document.querySelectorAll('.category-delete');
            for (var i = 0; i < categoryDel.length; i++) {
                categoryDel[i].addEventListener('click', function(event) {
                    if (confirm('確認刪除?')) {
                        var newsId = this.getAttribute("category-id");
                        var params = {
                            "category_id" : newsId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_CATEGORY_DO_DELETE }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                window.location.replace('{{ URL_DASHBOARD_CATEGORY }}');
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