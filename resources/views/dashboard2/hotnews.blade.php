@extends('dashboard2.layout')

@section('title', '最新消息 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('dashboard2.include.alert')

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">最新消息列表</h3>

                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary" onclick="newsAdd(this);">新增</button>
                    </div>
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
                            <th>描述</th>
                            <th>建立日期</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($hotNews as $key => $val)
                            <tr>
                                <td headers="id">{{ $val->id }}</td>
                                <td>{{ $i++ }}</td>
                                <td headers="image_url">{{ IMAGE_URL . '/' . $val->image_url }}</td>
                                <td>
                                    <img src="{{ IMAGE_URL . $val->image_url }}" />
                                </td>
                                <td headers="desc">{{ $val->desc }}</td>
                                <td>{{ substr($val->created_at , 0 , 10) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" onclick="newsEdit(this);"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default" onclick="newsDel(this);"><i class="fa fa-remove"></i></button>
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

    <form id="del-news" method="post" action="{{ URL_DASHBOARD2_HOTNEWS_DO_DEL }}" style="display: none">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="">
    </form>

    <div id="edit-news" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">最新消息 編輯</h4>
                </div>
                <form role="form" method="post" action="{{ URL_DASHBOARD2_HOTNEWS_DO_SAVE }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="desc" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Picture -->
                        <div class="form-group">
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
        var newsAdd = function(el) {
            $('#edit-news').find('input[name="id"]').val('0');
            $('#edit-news').find('textarea[name="desc"]').val('');
            $('#edit-news').find('input[name="image"]').prop('required', true);
            $('#edit-news').modal('show');
            removeUpload();
        };
        var newsEdit = function(el) {
            var rowTr = $(el).closest("tr");
            var newID = rowTr.find('td[headers="id"]').text();
            var newdesc = rowTr.find('td[headers="desc"]').text();
            var newImageUrl = rowTr.find('td[headers="image_url"]').text();

            $('#edit-news').find('input[name="id"]').val(newID);
            $('#edit-news').find('textarea[name="desc"]').val(newdesc);
            $('#edit-news').find('input[name="image"]').prop('required', false);
            $('#edit-news').modal('show');
            loadPreviewImageByUrl(newImageUrl);
        };
        var newsDel = function(el) {
            var rowTr = $(el).closest("tr");
            var newsId = rowTr.find('td[headers="id"]').text();
            var newsDesc = rowTr.find('td[headers="desc"]').text();
            var message = '是否確認刪除 ' + newsDesc;

            $('#del-news').find('input[name="id"]').val(newsId);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };
        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#del-news').submit();
        });

        $(function () {
            $('#news-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0, 2], className: 'hide_column'},
                    {targets: [1], width: '50px'},
                    {targets: [6], width: '100px'}
                ]
            });
        })
    </script>
@endsection