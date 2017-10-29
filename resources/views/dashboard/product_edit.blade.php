@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('inner-css')
    {{--<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />--}}

    <!-- dropzone -->
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

    <style>
        .droparea {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }
        #material-images img {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        產品管理-編輯
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_PRODUCT_DO_EDIT }}">

                        <div class="form-group" style="display: none;">
                            <label>ID</label>
                            <input id="product_id" name="product_id" class="form-control" value="{{ $product->id }}">
                        </div>

                        <div class="form-group" {!! is_null($product->id) ? "style=\"display: none;\"" : "" !!}>
                            <label>SN.</label>
                            <input name="product_sn" disabled class="form-control" value="{{ $siteVar['sn_prefix'] . str_pad($product->id, 5, '0', STR_PAD_LEFT) }}">
                        </div>

                        <div class="form-group">
                            <label>標題 / 產品名稱 (100)</label>
                            <input name="product_name" class="form-control" value="{{ $product->name }}">
                        </div>

                        <div class="form-group">
                            <label>副標題 (100)</label>
                            <input name="product_subtitle" class="form-control" value="{{ $product->subtitle }}">
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label>Multiple Selects</label>--}}
                            {{--<select name="multiple[]" multiple="" class="form-control">--}}
                                {{--<option value="1">1</option>--}}
                                {{--<option value="2">2</option>--}}
                                {{--<option value="3">3</option>--}}
                                {{--<option value="4">4</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label>類別</label>
                            <select name="category_ids" class="form-control">
                                @foreach($categories as $key => $val)
                                    <option {{ $categoryList->category_id == $val->id ? "selected=\"selected\"" : "" }} value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>系列</label>
                            <select name="series_ids" class="form-control">
                                @foreach($series as $key => $val)
                                    <option {{ $seriesList->series_id == $val->id ? "selected=\"selected\"" : "" }} value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>長 / length</label>
                            <input name="product_length" class="form-control" value="{{ $product->length }}">
                        </div>

                        <div class="form-group">
                            <label>寬 / width</label>
                            <input name="product_width" class="form-control" value="{{ $product->width }}">
                        </div>

                        <div class="form-group">
                            <label>高 / height</label>
                            <input name="product_height" class="form-control" value="{{ $product->height }}">
                        </div>

                        <div class="form-group">
                            <label>顯示</label>
                            <select name="product_display" class="form-control">
                                <option value="Y" {{ $product->display === "Y" ? "selected=\"selected\"" : "" }}>是</option>
                                <option value="N" {{ $product->display === "N" ? "selected=\"selected\"" : "" }}>否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>有效</label>
                            <select name="product_active" class="form-control">
                                <option value="Y" {{ $product->active === "Y" ? "selected=\"selected\"" : "" }}>是</option>
                                <option value="N" {{ $product->active === "N" ? "selected=\"selected\"" : "" }}>否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>描述 (500)</label>
                            <textarea name="product_content" class="form-control" rows="3">{{ $product->content }}</textarea>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-default">Reset Button</button>

                    </form>
                </div>
            </div>


            {{-------------Material-------------------------------------------------------------------}}
            @if(!$materials->isEmpty())
                <form id="material-form" method="post" action="{{ asset(URL_DASHBOARD_PRODUCT_DO_ADD_MATERIAL) }}">
                    <select name="material_id" class="form-control">
                        @foreach($materials as $key => $val)
                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-primary" onclick="document.querySelector('#material-form').submit();">新增材質</button>
                </form>
            @endif

            <div id="material-items" class="row">
                <div class="col-lg-12">
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>材質</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($materialList as $key => $val)
                                <tr material_id="{{ $val->material->id }}">
                                    <td>{{ $siteVar['mat_prefix'] . str_pad($val->material->id, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $val->material->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Material List -->
            <div id="material-list" class="row">
                {{--<div class="col-sm-12 imageDropable">--}}
                    {{--<form class="dropzone droparea">--}}
                    {{--</form>--}}
                {{--</div>--}}
            </div>

            <!-- Material Images -->
            <div id="material-images" class="row">
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection

@section('inner-js')
    {{--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>--}}

    <!-- dropzone -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        //Dropzone Configuration
        Dropzone.autoDiscover = false;

        function dropzoneInit() {
            $(".dropzone").dropzone({
                dictDefaultMessage: "Drag image here",
                uploadMultiple: false,
                parallelUploads: 1,
                clickable: true,
                maxFiles: 5,
                url: '{{ asset(API_PRODUCT_IMAGES_UPLOAD) }}' // Provide URL
            });
        }


        // Document Ready
        if (document.readyState === 'complete' || document.readyState !== 'loading') {
            eventHandler();
        } else {
            document.addEventListener('DOMContentLoaded', eventHandler);
        }

        function eventHandler()  {

            // 材質table click
            $('#material-items table tbody tr').click(function() {
                var product_id = document.querySelector('#product_id').value;
                var material_id = this.getAttribute('material_id');
                var params = {
                    "product_id" : product_id,
                    "material_id" : material_id
                };
                $.ajax({
                    url : '{{ API_PRODUCT_IMAGES_GET }}',
                    data: params,
                    type: 'GET'
                }).done(function(data) {
                    // 上傳圖片區塊
                    $('#material-list').empty();
                    var materialListContent =
                        '<div class="col-sm-12 imageDropable">' +
                        '<form class="dropzone droparea">' +
                        '<input name="product_id" value="' + product_id + '" style="display: none">' +
                        '<input name="material_id" value="' + material_id + '" style="display: none">' +
                        '</form>' +
                        '</div>';
                    $('#material-list').append(materialListContent);
                    dropzoneInit();

                    // 顯示圖片區塊
                    $('#material-images').empty();
                    if (data.status === true) {

                        var materialImages = '';
                        data.value.forEach(function(element) {
                           console.log(element);
                            materialImages = materialImages +
                                '<div class="col-sm-3">' +
                                '<img src="' + element.image_url + '">' +
                                '</div>';
                        });

                        $('#material-images').append(materialImages);
                    }
                });
            });

        }
    </script>
@endsection
