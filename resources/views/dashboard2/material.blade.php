@extends('dashboard2.layout')

@section('title', '材質管理 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('dashboard2.include.alert')

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">材質列表</h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary" onclick="materialAdd(this);">新增</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="material-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>SN</th>
                            <th>材質名稱</th>
                            <th>image_url</th>
                            <th>材質圖片</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $key => $val)
                            <tr>
                                <td headers="id">{{ $val->id }}</td>
                                <td headers="sn">{{ 'MAT' . str_pad($val->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td headers="name">{{ $val->name }}</td>
                                <td headers="image_url">{{ IMAGE_URL . $val->image_url }}</td>
                                <td><img src="{{ IMAGE_URL . $val->image_url }}" /></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" onclick="materialEdit(this);"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default" onclick="materialDel(this);"><i class="fa fa-remove"></i></button>
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

    <form id="del-material" method="post" action="{{ URL_DASHBOARD2_MATERIAL_DO_DEL }}" style="display: none">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="">
    </form>

    <div id="edit-material" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">最新消息 編輯</h4>
                </div>
                <form role="form" method="post" action="{{ URL_DASHBOARD2_MATERIAL_DO_SAVE }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>SN.</label>
                            <input name="sn" disabled class="form-control">
                        </div>
                        <div class="form-group">
                            <label>材質名稱 (100)</label>
                            <input name="name" class="form-control" required="required">
                        </div>
                        <!-- Picture -->
                        <div class="form-group">
                            <label>上傳圖片</label>
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input name="image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/jpg,image/jpeg" />
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
        var materialAdd = function(el) {
            // default
            $('#edit-material').find('form input[name="id"]').attr('value', '0');
            $('#edit-material').find('form input[name="sn"]').attr('value', '');
            $('#edit-material').find('form input[name="sn"]').parent().hide();
            $('#edit-material').find('form input[name="name"]').attr('value', '');
            document.querySelector("#edit-material form").reset();
            $('#edit-material').find('input[name="image"]').prop('required', true);
            $('#edit-material').modal('show');
            removeUpload();
        };
        var materialEdit = function(el) {
            var rowTr = $(el).closest("tr");
            var materialId = rowTr.find('td[headers="id"]').text();
            var materialSn = rowTr.find('td[headers="sn"]').text();
            var materialName = rowTr.find('td[headers="name"]').text();
            var materialImageUrl = rowTr.find('td[headers="image_url"]').text();

            $('#edit-material').find('form input[name="id"]').attr('value', materialId);
            $('#edit-material').find('form input[name="sn"]').attr('value', materialSn);
            $('#edit-material').find('form input[name="sn"]').parent().show();
            $('#edit-material').find('form input[name="name"]').attr('value', materialName);
            $('#edit-material').find('input[name="image"]').prop('required', false);
            $('#edit-material').modal('show');
            loadPreviewImageByUrl(materialImageUrl);
        };
        var materialDel = function(el) {
            var rowTr = $(el).closest("tr");
            var materialId = rowTr.find('td[headers="id"]').text();
            var materialName = rowTr.find('td[headers="name"]').text();
            var message = '是否確認刪除 ' + materialName;

            $('#del-material').find('input[name="id"]').val(materialId);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };
        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#del-material').submit();
        });

        $(function () {
            $('#material-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0, 3], className: 'hide_column'},
                    {targets: [1], width: '50px'},
                    {targets: [5], width: '100px'}
                ]
            });
        })
    </script>
@endsection