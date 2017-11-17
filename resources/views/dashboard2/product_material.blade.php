@extends('dashboard2.layout')
@inject('commonPresenter', 'App\Presenter\CommonPresenter')
@inject('materialPresenter', 'App\Presenter\MaterialPresenter')

@section('title', '產品材質 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div id="product-info" class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <p class="lead">{{ $product->name }}</p>
                    <small><cite title="Source Title">{{ $product->subtitle }}</cite></small>
                </div>
                <div class="box-body">
                    <ul class="nav nav-stacked">
                        <li><p class="text-light-blue">{{ $product->length . ' x ' . $product->width . ' x ' .$product->height }}</p></li>
                        <li><p class="text-light-blue">{{ $product->categoryLists[0]->category->name }}</p></li>
                        <li><p class="text-light-blue">{{ $product->seriesLists[0]->series->name }}</p></li>
                        <li><p class="text-light-blue">顯示 : {{ $commonPresenter->yesNo($product->display) }}</p></li>
                        <li><p class="text-light-blue">有效 : {{ $commonPresenter->yesNo($product->active) }}</p></li>
                        <li><p class="text-light-blue">{{ $product->content }}</p></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            @include('dashboard2.include.validate')
            @include('dashboard2.include.alert')
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h4>產品材質管理</h4>
                </div>
                <div class="box-body">
                    @if($materialPresenter->materialOptions()->count() != $materialLists->count())
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-8">
                                <form id="add-material" method="post" action="{{ URL_DASHBOARD2_PRODUCT_DO_ADD_MATERIAL }}">
                                    <select name="material_id" class="form-control">
                                        @foreach($materialPresenter->materialOptions() as $val)
                                            @if($materialLists->whereIn('material_id', [$val->id])->count() < 1)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </div>
                            <div class="col-xs-4">
                                <button type="button" class="btn btn-block btn-primary"
                                        onclick="document.querySelector('#add-material').submit();">新增材質</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @foreach($materialLists as $materialList)
                <div class="box box-solid bg-light-blue-gradient" style="position: relative; left: 0px; top: 0px;">
                    <div class="box-header ui-sortable-handle">
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-primary btn-sm pull-right"
                                    data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm pull-right"
                                    style="margin-right: 15px;" onclick="deleteMaterialList(this);">
                                刪除材質
                            </button>
                            <button type="button" class="btn btn-primary btn-sm pull-right"
                                    style="margin-right: 15px;" onclick="resortMaterialImages(this);">
                                儲存排序
                            </button>
                            <button type="button" class="btn btn-primary btn-sm pull-right"
                                    style="margin-right: 15px;" onclick="productImageUpload(this);">
                                新增圖片
                            </button>
                        </div>

                        <i class="fa fa-photo"></i>
                        <h3 class="box-title"
                            data-material-list-id="{{ $materialList->id }}"
                            data-product-id="{{ $materialList->product_id }}"
                            data-material-id="{{ $materialList->material_id }}">
                            {{ $materialList->material->name }}
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row product-image-container">
                            @foreach($materialList->materialImages as $materialImage)
                                <div class="col-xs-2" data-material-image-id="{{ $materialImage->id }}">
                                    <span class="badge bg-red">刪除</span>
                                    <img class="img-thumbnail" src="{{ IMAGE_URL . $materialImage->image_url }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form id="delete-material-list" method="post" action="{{ URL_DASHBOARD2_PRODUCT_DO_DEL_MATERIAL }}" style="display: none">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="">
    </form>

    <div id="product-upload" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">產品 影像上傳</h4>
                </div>

                <div class="modal-body">
                    <div class="alert alert-info alert-dismissible">
                        <ul>
                            <li>單次最多上傳10張照片</li>
                            <li>僅上傳 jpg 圖檔</li>
                            <li>最大限制 3 MB</li>
                        </ul>
                    </div>

                    <form class="dropzone">
                        <input type="hidden" name="product_id" value="0">
                        <input type="hidden" name="material_id" value="0">
                        <input type="hidden" name="material_list_id" value="0">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Close</button>
                    <button id="upload-submit" type="button" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inner-js')
    <!-- jsDelivr :: Sortable :: Latest (http://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        // 圖片上傳
        productImageUpload = function(el) {
            var boxHeader = $(el).closest('.box-header');
            var infoH3 = boxHeader.find('h3');
            var materialListId = infoH3.attr('data-material-list-id');
            var productId = infoH3.attr('data-product-id');
            var materialId = infoH3.attr('data-material-id');

            $('#product-upload').find('form input[name="material_list_id"]').val(materialListId);
            $('#product-upload').find('form input[name="product_id"]').val(productId);
            $('#product-upload').find('form input[name="material_id"]').val(materialId);

            myDropzone.removeAllFiles(true);
            $('#product-upload').modal('show');
        };

        uploadClickFlag = false;
        $('#upload-submit').on('click', function() {
            uploadClickFlag = true;
            myDropzone.processQueue();
        });

        // 刪除材質
        deleteMaterialList = function(el) {
            var boxHeader = $(el).closest('.box-header');
            var infoH3 = boxHeader.find('h3');
            var materialListId = infoH3.attr('data-material-list-id');
            var materialName = infoH3.text();
            var message = '是否確認刪除 ' + materialName;

            $('#delete-material-list').find('input[name="id"]').val(materialListId);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };
        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#delete-material-list').submit();
        });

        // 排序
        resortMaterialImages = function(el) {
            var box = $(el).closest('.box');
            var arrMaterialList = [];
            var imageItem = box.find('.product-image-container div');
            imageItem.each(function(index) {
                var materialImageId = $(this).attr('data-material-image-id');
                arrMaterialList.push(materialImageId);
            });

            if (arrMaterialList.length == 0) return;
            var params = {
                "material_arr" : arrMaterialList,
                "_token" : $('meta[name="csrf-token"]').attr('content')
            };
            $.ajax({
                url : '{{ API_PRODUCT_IMAGES_RESORT }}',
                data: params,
                type: 'POST'
            }).done(function(resJson) {
                if (resJson.status === true) {
                    $('#alert-object p').text('排序完成');
                    $('#alert-object').attr('class', 'alert alert-success alert-dismissible');
                    $('#alert-object').show();
                } else {
                    $('#alert-object p').text('排序失敗');
                    $('#alert-object').attr('class', 'alert alert-danger alert-dismissible');
                    $('#alert-object').show();
                }
            });
        };

        // disable auto discover
        Dropzone.autoDiscover = false;
        var myDropzone;
        $(document).ready(function(){
            myDropzone = new Dropzone (".dropzone", {
                url: '{{ API_PRODUCT_IMAGES_UPLOAD }}',
                method: 'post',
                autoProcessQueue: false,
                acceptedFiles: 'image/jpg, image/jpeg',
                maxFiles: 10,
                parallelUploads: 10,
                maxFilesize: 3,
                addRemoveLinks: true
            });

            myDropzone.on("maxfilesexceeded", function(file) {
                // 刪除超過檔案數量限制的檔案
                myDropzone.removeFile(file);
            });

            // after myDropzone.processQueue();
            myDropzone.on("complete", function(file) {
                if (file.accepted != true) {
                    myDropzone.removeFile(file);
                    console.log('Remove ' + file.name);
                }
            });
            myDropzone.on("queuecomplete", function() {
                if (uploadClickFlag == true) {
                    console.log('queuecomplete');
                    uploadClickFlag = false;
                    location.reload();
                }
            });

            // sortable
            var foo = document.querySelectorAll(".product-image-container");
            foo.forEach(function(el) {
                Sortable.create(el);
            });

            // 單張刪除
            $('.product-image-container span').on('click', function() {
                var imageItem = $(this).parent();
                var id = imageItem.attr('data-material-image-id');
                var params = {
                    "id" : id,
                    "_token" : $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url : '{{ API_PRODUCT_IMAGES_DELETE }}',
                    data: params,
                    type: 'POST'
                }).done(function(resJson) {
                    if (resJson.status === true) {
                        imageItem.remove();
                        $('#alert-object p').text('刪除完成');
                        $('#alert-object').attr('class', 'alert alert-success alert-dismissible');
                        $('#alert-object').show();
                    } else {
                        $('#alert-object p').text('刪除失敗');
                        $('#alert-object').attr('class', 'alert alert-danger alert-dismissible');
                        $('#alert-object').show();
                    }
                });
            });
        });
    </script>
@endsection
