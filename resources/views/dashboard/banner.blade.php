@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Banner
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2></h2>
                    <div class="table-responsive">
                        <table id="banner-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i=1; $i<=5; $i++)
                                <tr>
                                    <td headers="id">{{ $i }}</td>
                                    @if(isset($banner[$i]))
                                        <td headers="value" style="display: none">{{ $banner[$i]->value }}</td>
                                        <td><img src="{{ IMAGE_URL . $banner[$i]->value }}" /></td>
                                    @else
                                        <td headers="value"style="display: none"></td>
                                        <td></td>
                                    @endif
                                    <td style="width: 80px; text-align: center">
                                        <button banner-id="{{ $i }}" type="button" class="btn btn-xs btn-danger banner-delete">刪除</button>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="banner-edit" class="col-md-8 col-md-offset-2">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_BANNER_DO_EDIT }}" enctype="multipart/form-data" style="display: none;">
                        <div class="form-group" style="display: none;">
                            <label>ID</label>
                            <input name="banner_id" class="form-control" value="">
                        </div>

                        <!-- Picture -->
                        <div class="form-group">
                            <label>上傳圖片</label>
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input name="banner_image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/jpg" />
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
                            <button type="button" class="btn btn-primary" onclick="document.querySelector('#banner-edit form').submit();">Save</button>
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
            $('#banner-table tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                // edit
                var bannerId = this.querySelector('[headers="id"]').textContent;
                // show editer
                $('#banner-edit form').show();
                $('#banner-edit form input[name="banner_id"]').attr('value', bannerId);
            });

            // news del click
            var bannerDel = document.querySelectorAll('.banner-delete');
            for (var i = 0; i < bannerDel.length; i++) {
                bannerDel[i].addEventListener('click', function(event) {
                    var delTr = $(this).closest('tr').find('[headers="value"]').text();
                    if (delTr.trim() == '') {
                        alert('沒有資料可以刪除');
                        return;
                    }

                    if (confirm('確認刪除?')) {
                        var bannerId = this.getAttribute("banner-id");
                        var params = {
                            "banner_id" : bannerId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_BANNER_DO_DELETE }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                window.location.replace('{{ URL_DASHBOARD_BANNER }}');
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