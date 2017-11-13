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

            <button id="material-add" type="button" class="btn btn-primary">新增</button>

            <div class="row">
                <div class="col-lg-6">
                    <h2></h2>
                    <div class="table-responsive">
                        <table id="material-table" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>材質名稱</th>
                                <th>材質圖片</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($materials as $key => $val)
                                <tr>
                                    <td headers="material_id" style="display: none;">{{ $val->id }}</td>
                                    <td headers="material_sn">{{ $siteVar['sn_prefix'] . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td headers="material_name">{{ $val->name }}</td>
                                    <td>
                                        <img src="{{ IMAGE_URL . $val->image_url }}" />
                                    </td>
                                    <td style="width: 80px; text-align: center">
                                        <button material-id="{{ $val->id }}" type="button" class="btn btn-xs btn-danger material-delete">刪除</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="material-edit" class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_MATERIAL_DO_EDIT }}" enctype="multipart/form-data" style="display: none;">
                        <div class="form-group" style="display: none">
                            <label>ID</label>
                            <input name="material_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>SN.</label>
                            <input name="material_sn" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label>材質名稱 (100)</label>
                            <input name="material_name" class="form-control" required="required">
                        </div>

                        <!-- Picture -->
                        <div class="form-group">
                            <label>上傳圖片</label>
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input name="material_image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/jpg,image/jpeg" />
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>
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
    <script src="{{ asset('/js/fileUploadInput.js') }}"></script>
    <script>
        // DOCUMENT READY
        function eventHandler() {

            // Highlight selected bar
            $('#material-table tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                // edit
                var materialId = this.querySelector('[headers="material_id"]').textContent;
                var materialSN = this.querySelector('[headers="material_sn"]').textContent;
                var materialName = this.querySelector('[headers="material_name"]').textContent;

                // show news editer
                $('#material-edit form').show();
                $('#material-edit form input[name="material_id"]').attr('value', materialId);
                $('#material-edit form input[name="material_sn"]').attr('value', materialSN.trim());
                $('#material-edit form input[name="material_sn"]').parent().show();
                $('#material-edit form input[name="material_name"]').attr('value', materialName);
            });

            // news add click
            var hotNewsAdd = document.querySelector('#material-add');
            hotNewsAdd.addEventListener('click', function (event) {
                $('#material-edit form').show();
                $('#material-edit form input[name="material_id"]').attr('value', '');
                $('#material-edit form input[name="material_sn"]').attr('value', '');
                $('#material-edit form input[name="material_sn"]').parent().hide();
                $('#material-edit form input[name="material_name"]').attr('value', '');
                document.querySelector("#material-edit form").reset();
            });

            // news del click
            var materialDel = document.querySelectorAll('.material-delete');
            for (var i = 0; i < materialDel.length; i++) {
                materialDel[i].addEventListener('click', function(event) {
                    if (confirm('確認刪除?')) {
                        var newsId = this.getAttribute("material-id");
                        var params = {
                            "material_id" : newsId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_MATERIAL_DO_DELETE }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                window.location.replace('{{ URL_DASHBOARD_MATERIAL }}');
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
