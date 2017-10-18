@extends('dashboard.layout')

@section('title', '日何百鐵')

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
                            <input name="product_id" class="form-control" value="{{ $product->id }}">
                        </div>

                        <div class="form-group" {!! is_null($product->id) ? "style=\"display: none;\"" : "" !!}>
                            <label>SN.</label>
                            <input name="product_sn" disabled class="form-control" value="{{ $siteVar['sn_prefix'] . str_pad($product->id, 5, '0', STR_PAD_LEFT) }}">
                        </div>

                        <div class="form-group">
                            <label>產品名稱</label>
                            <input name="product_name" class="form-control" value="{{ $product->name }}">
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
                            <label>描述(500)</label>
                            <textarea name="product_desc" class="form-control" rows="3">{{ $product->desc }}</textarea>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-default">Reset Button</button>

                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
@endsection
