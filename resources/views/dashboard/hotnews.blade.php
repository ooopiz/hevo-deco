@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        最新消息
                    </h1>
                </div>
            </div>

            <button id="news-add" type="button" class="btn btn-primary">新增</button>

            <div class="row">
                <div class="col-lg-6">
                    <h2></h2>
                    <div class="table-responsive">
                        <table id="news-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>圖片</th>
                                <th>描述</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($hotNews as $key => $val)
                                <tr>
                                    <td headers="id" style="display: none;">{{ $val->id }}</td>
                                    <td style="width: 50px">{{ $i++ }}</td>
                                    <td>
                                        <img src="{{ IMAGE_URL . $val->image_url }}" />
                                    </td>
                                    <td headers="desc">{{ $val->desc }}</td>
                                    <td style="width: 80px; text-align: center">
                                        <button news-id="{{ $val->id }}" type="button" class="btn btn-xs btn-danger news-delete">刪除</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="news-edit" class="col-lg-6">

                    <form role="form" method="post" action="{{ URL_DASHBOARD_HOTNEWS_DO_EDIT }}" enctype="multipart/form-data" style="display: none;">
                        <div class="form-group" style="display: none;">
                            <label>ID</label>
                            <input name="news_id" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="news_desc" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Picture -->
                        <div class="form-group">
                            <label>上傳圖片</label>
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                <div class="image-upload-wrap">
                                    <input name="news_image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/jpg" />
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
            $('#news-table tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                // edit
                var newsId = this.querySelector('[headers="id"]').textContent;
                var newsDesc = this.querySelector('[headers="desc"]').textContent;
                // show news editer
                $('#news-edit form').show();
                $('#news-edit form input[name="news_id"]').attr('value', newsId);
                $('#news-edit form textarea[name="news_desc"]').text(newsDesc);
            });

            // news add click
            var hotNewsAdd = document.querySelector('#news-add');
            hotNewsAdd.addEventListener('click', function (event) {
                $('#news-edit form').show();
                $('#news-edit form input[name="news_id"]').attr('value', '');
                $('#news-edit form textarea[name="news_desc"]').text('');
                document.querySelector("#news-edit form").reset();
            });

            // news del click
            var hotNewsDel = document.querySelectorAll('.news-delete');
            for (var i = 0; i < hotNewsDel.length; i++) {
                hotNewsDel[i].addEventListener('click', function(event) {
                    if (confirm('確認刪除?')) {
                        var newsId = this.getAttribute("news-id");
                        var params = {
                            "news_id" : newsId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_HOTNEWS_DO_DELETE }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                window.location.replace('{{ URL_DASHBOARD_HOTNEWS }}');
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