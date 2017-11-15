@extends('dashboard2.layout')

@section('title', 'BANNER | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('dashboard2.include.alert')

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">輪播大圖列表</h3>
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
                                <td headers="no">{{ $i }}</td>
                                @if(isset($banner[$i]))
                                    <td headers="value">{{ $banner[$i]->value }}</td>
                                    <td><img src="{{ IMAGE_URL . $banner[$i]->value }}" /></td>
                                @else
                                    <td headers="value"></td>
                                    <td></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" onclick="bannerUpload(this);"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default" onclick="bannerDel(this);"><i class="fa fa-remove"></i></button>
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

    <form id="del-banner" method="post" action="{{ URL_DASHBOARD2_BANNER_DO_DEL }}" style="display: none">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="no" value="">
    </form>

    <div id="banner-upload" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">BANNER 影像上傳</h4>
                </div>

                <form role="form" method="post" action="{{ URL_DASHBOARD2_BANNER_DO_SAVE }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input name="banner_image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/jpg,image/jpeg" />
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
                        <input type="hidden" name="no" value="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
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
        var bannerUpload = function(el) {
            var rowTr = $(el).closest("tr");
            var bannerNo = rowTr.find('td[headers="no"]').text();

            $('#banner-upload').find('input[name="no"]').val(bannerNo);
            $('#banner-upload').modal('show');
        };

        var bannerDel = function(el) {
            var rowTr = $(el).closest("tr");
            var bannerNo = rowTr.find('td[headers="no"]').text();
            var bannerValue = rowTr.find('td[headers="value"]').text();
            if (bannerValue == '') {
                $('#alert-object').attr('class', 'alert alert-info alert-dismissible');
                $('#alert-object p').text('Nothing to do ...');
                $('#alert-object').show();
                return;
            }

            var message = '是否確認刪除 NO.' + bannerNo;

            $('#del-banner').find('input[name="no"]').val(bannerNo);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };
        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#del-banner').submit();
        });

        $(function () {
            $('#banner-table').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0], width: '50px'},
                    {targets: [1], className: 'hide_column'},
                    {targets: [3], width: '100px'}
                ]
            });
        })
    </script>
@endsection