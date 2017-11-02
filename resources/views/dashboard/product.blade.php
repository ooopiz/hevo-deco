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
                                    <th>ID</th>
                                    <th>SN.</th>
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

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection

@section('inner-js')
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
                        '<td headers="id">' + element.id + '</td>' +
                        '<td headers="sn">' + 'MAT' + paddingLeft(element.id, 3) + '</td>' +
                        '<td headers="name">' + element.material.name + '</td>' +
                        '<td style="width: 80px; text-align: center">' +
                        '<button maaterial-id="' + element.id + '" type="button" class="btn btn-xs btn-danger material-delete">刪除</button>' +
                        '</td>';
                });
                $('#material-list tbody').empty();
                $('#material-list tbody').append(dom);
            }
        };

        // DOCUMENT READY
        function eventHandler() {

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

                //material
                $('#material-container').show();

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
        }
        if (document.readyState === 'complete' || document.readyState !== 'loading') {
            eventHandler();
        } else {
            document.addEventListener('DOMContentLoaded', eventHandler);
        }
    </script>
@endsection