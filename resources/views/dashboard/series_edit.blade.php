@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        系列管理-編輯
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_SERIES_DO_EDIT }}">
                        <div class="form-group" style="display: none;">
                            <label>ID</label>
                            <input name="series_id" class="form-control" value="{{ $series->id }}">
                        </div>

                        <div class="form-group" {!! is_null($series->id) ? "style=\"display: none;\"" : "" !!}>
                            <label>SN.</label>
                            <input name="series_sn" disabled class="form-control" value="{{ $siteVar['sn_prefix'] . str_pad($series->id, 3, '0', STR_PAD_LEFT) }}">
                        </div>

                        <div class="form-group">
                            <label>系列名稱 (100)</label>
                            <input name="series_name" class="form-control" value="{{ $series->name }}">
                        </div>

                        <div class="form-group">
                            <label>顯示</label>
                            <select name="series_display" class="form-control">
                                <option value="Y" {{ $series->display === "Y" ? "selected=\"selected\"" : "" }}>是</option>
                                <option value="N" {{ $series->display === "N" ? "selected=\"selected\"" : "" }}>否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>有效</label>
                            <select name="series_active" class="form-control">
                                <option value="Y" {{ $series->active === "Y" ? "selected=\"selected\"" : "" }}>是</option>
                                <option value="N" {{ $series->active === "N" ? "selected=\"selected\"" : "" }}>否</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>描述 (250)</label>
                            <textarea name="series_desc" class="form-control" rows="3">{{ $series->desc }}</textarea>
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
