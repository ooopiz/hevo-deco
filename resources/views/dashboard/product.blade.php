@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        產品管理
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <button id="product-add" type="button" class="btn btn-primary">新增</button>

            <div class="row">
                <div id="product-list" class="col-lg-12">
                    <h2></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SN.</th>
                                <th>產品</th>
                                <th>副標題</th>
                                <th>尺寸</th>
                                <th>類別</th>
                                <th>系列</th>
                                <th>顯示</th>
                                <th>有效</th>
                                <th>內文</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $val)
                                <tr>
                                    <td headers="product_id" style="display: none;">{{ $val->id }}</td>
                                    <td headers="product_sn">{{ $siteVar['sn_prefix'] . str_pad($val->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td headers="product_name">{{ $val->name }}</td>
                                    <td headers="product_subtitle">{{ $val->subtitle }}</td>
                                    <td>{{ $val->length . ' x ' . $val->width . ' x ' . $val->height }}</td>
                                    <td headers="product_length" style="display: none;">{{ $val->length }}</td>
                                    <td headers="product_width" style="display: none;">{{ $val->width }}</td>
                                    <td headers="product_height" style="display: none;">{{ $val->height }}</td>

                                    <td headers="product_category_id" style="display: none;">{{ $val->categoryLists[0]->category->id }}</td>
                                    <td headers="product_category_name">{{ $val->categoryLists[0]->category->name }}</td>

                                    <td headers="product_series_id" style="display: none;">{{ $val->seriesLists[0]->series->id }}</td>
                                    <td headers="product_series_name">{{ $val->seriesLists[0]->series->name }}</td>
                                    <td headers="product_display">{{ $val->display }}</td>
                                    <td headers="product_active">{{ $val->active }}</td>
                                    <td headers="product_content">{{ $val->content }}</td>
                                    <td style="width: 80px; text-align: center">
                                        <button product-id="{{ $val->id }}" type="button" class="btn btn-xs btn-danger product-delete">刪除</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="material-container" class="col-xs-6" style="display: none">
                    @if(!$materials->isEmpty())
                        <div id="material-add-container">
                            <div class="form-group">
                                <select name="material_id" class="form-control">
                                    @foreach($materials as $key => $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button id="material-add" type="button" class="btn btn-primary">新增材質</button>
                        </div>
                    @endif

                    <!-- Material -->
                        <div class="col-lg-6">
                            <h2></h2>
                            <div class="table-responsive">
                                <table id="material-list" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="display: none">ID</th>
                                    <th>SN</th>
                                    <th>材質</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <!-- end material-container -->

                <div id="product-edit" class="col-xs-6" style="display: none;">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_PRODUCT_DO_EDIT }}">
                        <div class="form-group" style="display: none;">
                            <label>ID</label>
                            <input id="product_id" name="product_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>SN.</label>
                            <input name="product_sn" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label>標題 / 產品名稱 (100)</label>
                            <input name="product_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>副標題 (100)</label>
                            <input name="product_subtitle" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>類別</label>
                            <select name="category_ids" class="form-control">
                                @foreach($categories as $key => $val)
                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>系列</label>
                            <select name="series_ids" class="form-control">
                                @foreach($series as $key => $val)
                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>長 / length</label>
                            <input name="product_length" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>寬 / width</label>
                            <input name="product_width" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>高 / height</label>
                            <input name="product_height" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>顯示</label>
                            <select name="product_display" class="form-control">
                                <option value="Y">是</option>
                                <option value="N">否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>有效</label>
                            <select name="product_active" class="form-control">
                                <option value="Y">是</option>
                                <option value="N">否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>描述 (500)</label>
                            <textarea name="product_content" class="form-control" rows="3"></textarea>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="text-center form-button">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>

            </div>

            <div id="material-image-add" class="row" style="display: none;">
                <div class="col-xs-6">
                    <form id="material-edit" role="form">
                        <div class="form-group" style="display: none;">
                            <label>material_list_id</label>
                            <input name="material_list_id" class="form-control">
                        </div>
                        <div class="form-group" style="display: none;">
                            <label>product_id</label>
                            <input name="product_id" class="form-control">
                        </div>

                        <div class="form-group" style="display: none;">
                            <label>material_id</label>
                            <input name="material_id" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>上傳圖片</label>
                            <div class="file-upload">
                                {{--<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>--}}

                                <div class="image-upload-wrap">
                                    <input name="material_image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/jpg" />
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

                        <div class="text-center form-button">
                            <button id="material-image-save" type="button" class="btn btn-primary">UPLOAD</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="material-images-container" class="row" style="display: none;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">產品圖片</h3>
                            <button id="resort-image-order" type="button" class="btn btn-xs btn-primary">儲存排序</button>
                        </div>
                        <div class="panel-body">
                            <div id="material-images" class="row"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection

@section('inner-js')
    <script src="{{ asset('/js/fileUploadInput.js') }}"></script>

    <!-- jsDelivr :: Sortable :: Latest (http://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        var paddingLeft = function(str, lenght) {
            if(str.length >= lenght)
                return str;
            else
                return paddingLeft('0' + str, lenght);
        };

        var refreshMaterial = function(materials, material_list) {
            if (materials.length == 0) {
                $('#material-add-container').hide();
                $('#material-add-container select').empty();
            } else {
                $('#material-add-container').show();
                var options = '';
                materials.forEach(function(element) {
                    options = options +
                        '<option value="' + element.id + '">' + element.name+'</option>';
                });
                $('#material-add-container select').empty();
                $('#material-add-container select').append(options);
            }

            if (material_list.length == 0) {
                $('#material-list tbody').empty();
            } else {
                var dom = '';
                material_list.forEach(function(element) {
                    dom = dom +
                        '<tr>' +
                        '<td headers="material_list_id" style="display: none">' + element.id + '</td>' +
                        '<td headers="product_id" style="display: none">' + element.product_id + '</td>' +
                        '<td headers="material_id" style="display: none">' + element.material_id + '</td>' +
                        '<td headers="sn">' + 'MAT' + paddingLeft(element.material_id, 3) + '</td>' +
                        '<td headers="name">' + element.material.name + '</td>' +
                        '<td style="width: 80px; text-align: center">' +
                        '<button material-id="' + element.material_id + '" product-id="' + element.product_id + '" type="button" class="btn btn-xs btn-danger material-delete">刪除</button>' +
                        '</td>';
                });
                $('#material-list tbody').empty();
                $('#material-list tbody').append(dom);
            }

            addMaterialSelectEvent();
            addMaterialDelEvent();
        };

        var addMaterialDelEvent = function () {
            var materialtDel = document.querySelectorAll('.material-delete');
            for (var i = 0; i < materialtDel.length; i++) {
                materialtDel[i].addEventListener('click', function(event) {
                    if (confirm('確認刪除?')) {
                        var productId = this.getAttribute("product-id");
                        var materialId = this.getAttribute("material-id");
                        var params = {
                            "product_id" : productId,
                            "material_id" : materialId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_MATERIAL_DO_DELETE_BY_PRODUCT }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                refreshMaterial(data.materials, data.material_list);
                            }
                        });
                    }
                });
            }
        };

        var addMaterialSelectEvent = function () {
            // Highlight selected bar
            $('#material-list tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                //hind product editor
                $('#product-edit form').hide();

                //get table data
                var materialListId = this.querySelector('[headers="material_list_id"]').textContent;
                var productId = this.querySelector('[headers="product_id"]').textContent;
                var materialId = this.querySelector('[headers="material_id"]').textContent;

                //set form data
                $('#material-edit input[name="material_list_id"]').attr('value', materialListId);
                $('#material-edit input[name="product_id"]').attr('value', productId);
                $('#material-edit input[name="material_id"]').attr('value', materialId);

                // hide material image add show
                $('#material-image-add').show();

                refreshMaterialImages(productId, materialId);
            });
        };

        var refreshMaterialImages = function(product_id, material_id) {
            var params = {
                "product_id" : product_id,
                "material_id" : material_id
            };
            $.ajax({
                url : '{{ API_PRODUCT_IMAGES_GET }}',
                data: params,
                type: 'GET'
            }).done(function(data) {
                // 顯示圖片區塊
                $('#material-images').empty();
                if (data.status === true) {
                    var materialImages = '';
                    data.material_images.forEach(function(element) {
                        materialImages = materialImages +
                            '<div class="col-xs-3" material_list_id="'+ element.id +'" product_id="' + product_id +'" material_id="' + material_id + '" order="' + element.order + '">' +
                            '<img src="{{ IMAGE_URL }}'  + element.image_url + '">' +
                            '<button material_image_id="' + element.id + '" type="button" class="btn btn-danger" onClick="materialImageDelete(this);">刪除</button>' +
                            '</div>';
                    });
                    $('#material-images').append(materialImages);
                }
                $('#material-images-container').show();
            });
        };

        var materialImageDelete = function materialImageDelete(el) {
            var productId = $(el).parent().attr('product_id');
            var materialId = $(el).parent().attr('material_id');
            var order = $(el).parent().attr('order');
            var params = {
                "product_id" : productId,
                "material_id" : materialId,
                "order"  : order,
                "_token" : $('meta[name="csrf-token"]').attr('content')
            };
            $.ajax({
                url : '{{ API_PRODUCT_IMAGES_DELETE }}',
                data: params,
                type: 'POST'
            }).done(function(resJson) {
                if (resJson.status === true) {
                    $(el).parent().remove();
                } else {
                    alert('刪除失敗');
                    return;
                }
            });
        };

        // DOCUMENT READY
        function eventHandler() {

            var foo = document.getElementById("material-images");
            Sortable.create(foo, { group: "omega" });

            $('#material-image-save').click(function() {
                var materialListId = document.querySelector('#material-edit input[name="material_list_id"]').value;
                var productId = document.querySelector('#material-edit input[name="product_id"]').value;
                var materialId = document.querySelector('#material-edit input[name="material_id"]').value;
                var fileImage = document.querySelector('#material-edit input[name="material_image"]');
                var files = fileImage.files;
                if (files.length != 1) {
                    alert("尚未選擇上傳圖片");
                    return;
                }

                var formData = new FormData();
                formData.append('material_image', files[0]);
                formData.append('material_list_id', materialListId);
                formData.append('product_id', productId);
                formData.append('material_id', materialId);

                $.ajax({
                    url : '{{ API_PRODUCT_IMAGES_UPLOAD }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'POST'
                }).done(function(resJson) {
                    if (resJson.status === true) {
                        //TODO delete preview

                        refreshMaterialImages(productId, materialId);
                    } else {
                        alert("上傳失敗");
                        return;
                    }
                });
            });

            // Highlight selected bar
            $('#product-list table tbody tr').click(function() {
                $(this).addClass('bg-success').siblings().removeClass('bg-success');

                // edit
                var productId = this.querySelector('[headers="product_id"]').textContent;
                var productSN = this.querySelector('[headers="product_sn"]').textContent;
                var productName = this.querySelector('[headers="product_name"]').textContent;
                var productSubtitle = this.querySelector('[headers="product_subtitle"]').textContent;
                var productCategoryId = this.querySelector('[headers="product_category_id"]').textContent;
                var productSeriesID = this.querySelector('[headers="product_series_id"]').textContent;
                var productDisplay = this.querySelector('[headers="product_display"]').textContent;
                var productActive = this.querySelector('[headers="product_active"]').textContent;
                var productDesc = this.querySelector('[headers="product_content"]').textContent;

                var productLength = this.querySelector('[headers="product_length"]').textContent.trim();
                var productWidth = this.querySelector('[headers="product_width"]').textContent.trim();
                var productHeight = this.querySelector('[headers="product_height"]').textContent.trim();

                // show news editer
                $('#product-edit').show();
                $('#product-edit form input[name="product_id"]').attr('value', productId);
                $('#product-edit form input[name="product_sn"]').attr('value', productSN.trim());
                $('#product-edit form input[name="product_sn"]').parent().show();
                $('#product-edit form input[name="product_name"]').attr('value', productName);
                $('#product-edit form input[name="product_subtitle"]').attr('value', productSubtitle);
                //類別category_ids
                document.querySelector('#product-edit form select[name="category_ids"]').value = productCategoryId;
                //系列series_ids
                document.querySelector('#product-edit form select[name="series_ids"]').value = productSeriesID;
                $('#product-edit form input[name="product_length"]').attr('value', '');
                $('#product-edit form input[name="product_width"]').attr('value', '');
                $('#product-edit form input[name="product_height"]').attr('value', '');
                document.querySelector('#product-edit form select[name="product_display"]').value = productDisplay;
                document.querySelector('#product-edit form select[name="product_active"]').value = productActive;
                $('#product-edit form textarea[name="product_content"]').text(productDesc);

                $('#product-edit form input[name="product_length"]').attr('value', productLength);
                $('#product-edit form input[name="product_width"]').attr('value', productWidth);
                $('#product-edit form input[name="product_height"]').attr('value', productHeight);

                // product editor show
                $('#product-edit form').show();

                // hide material image add area
                $('#material-image-add').hide();

                //material
                $('#material-container').show();

                //material image
                $('#material-images-container').hide();

                var params = {
                    "product_id" : productId,
                    "_token" : $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url : '{{ API_GET_MATERIAL_LIST_BY_PRODUCT }}',
                    data: params,
                    type: 'POST'
                }).done(function(data) {
                    if (data.status === true) {
                        refreshMaterial(data.materials, data.material_list);
                    }
                });
            });

            // news add click
            var productAdd = document.querySelector('#product-add');
            productAdd.addEventListener('click', function (event) {

                $('#product-edit').show();
                $('#product-edit form input[name="product_id"]').attr('value', '');
                $('#product-edit form input[name="product_sn"]').attr('value', '');
                $('#product-edit form input[name="product_sn"]').parent().hide();
                $('#product-edit form input[name="product_name"]').attr('value', '');
                $('#product-edit form input[name="product_subtitle"]').attr('value', '');
                //類別category_ids
                document.querySelector('#product-edit form select[name="category_ids"]').selectedIndex = 0;
                //系列series_ids
                document.querySelector('#product-edit form select[name="series_ids"]').selectedIndex = 0;
                $('#product-edit form input[name="product_length"]').attr('value', '');
                $('#product-edit form input[name="product_width"]').attr('value', '');
                $('#product-edit form input[name="product_height"]').attr('value', '');
                document.querySelector('#product-edit form select[name="product_display"]').value = 'Y';
                document.querySelector('#product-edit form select[name="product_active"]').value = 'Y';
                $('#product-edit form textarea[name="product_content"]').text('');
                document.querySelector("#product-edit form").reset();

                // material
                $('#material-container').hide();
            });

            // del click
            var productDel = document.querySelectorAll('.product-delete');
            for (var i = 0; i < productDel.length; i++) {
                productDel[i].addEventListener('click', function(event) {
                    if (confirm('確認刪除?')) {
                        var productId = this.getAttribute("product-id");
                        var params = {
                            "product_id" : productId,
                            "_token" : $('meta[name="csrf-token"]').attr('content')
                        };
                        $.ajax({
                            url : '{{ API_PRODUCT_DO_DELETE }}',
                            data: params,
                            type: 'POST'
                        }).done(function(data) {
                            if (data.status === true) {
                                window.location.replace('{{ URL_DASHBOARD_PRODUCT }}');
                            }
                        });
                    }
                });
            }

            // 新增材質
            var materialAdd = document.querySelector('#material-add');
            materialAdd.addEventListener('click', function (event) {
                var productId = $('#product-edit form input[name="product_id"]').val();
                var materialId = document.querySelector('#material-add-container select').value;
                var params = {
                    "product_id" : productId,
                    "material_id" : materialId,
                    "_token" : $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url : '{{ API_ADD_MATERIAL_LIST }}',
                    data: params,
                    type: 'POST'
                }).done(function(data) {
                    if (data.status === true) {
                        refreshMaterial(data.materials, data.material_list);
                    }
                });
            });

            var reSortOrder = document.querySelector('#resort-image-order');
            reSortOrder.addEventListener('click', function(event) {
                var arrMaterialList = [];
                $('#material-images div').each(function(index) {
                    var materialListId = $(this).attr('material_list_id');
                    arrMaterialList.push(materialListId);
                });
                console.log(arrMaterialList);

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
                        alert('排序完成');
                    } else {
                        alert('Resort 失敗');
                    }
                });
            });

        }
        if (document.readyState === 'complete' || document.readyState !== 'loading') {
            eventHandler();
        } else {
            document.addEventListener('DOMContentLoaded', eventHandler);
        }
    </script>
@endsection