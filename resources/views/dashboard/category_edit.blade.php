@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        類別管理-編輯
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_CATEGORY_DO_EDIT }}">
                        <div class="form-group" style="display: none">
                            <label>ID</label>
                            <input name="category_id" class="form-control" value="{{ $category->id }}">
                        </div>

                        <div class="form-group" {!! is_null($category->id) ? "style=\"display: none;\"" : "" !!}>
                            <label>SN.</label>
                            <input name="category_sn" disabled class="form-control" value="{{ $siteVar['sn_prefix'] . str_pad($category->id, 3, '0', STR_PAD_LEFT) }}">
                        </div>

                        <div class="form-group">
                            <label>類別名稱 (100)</label>
                            <input name="category_name" class="form-control" value="{{ $category->name }}">
                        </div>

                        <div class="form-group">
                            <label>顯示</label>
                            <select name="category_display" class="form-control">
                                <option value="Y" {{ $category->display === "Y" ? "selected=\"selected\"" : "" }}>是</option>
                                <option value="N" {{ $category->display === "N" ? "selected=\"selected\"" : "" }}>否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>有效</label>
                            <select name="category_active" class="form-control">
                                <option value="Y" {{ $category->active === "Y" ? "selected=\"selected\"" : "" }}>是</option>
                                <option value="N" {{ $category->active === "N" ? "selected=\"selected\"" : "" }}>否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="category_desc" class="form-control" rows="3">{{ $category->desc }}</textarea>
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
