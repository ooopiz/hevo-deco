@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        材質管理-編輯
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form role="form" method="post" action="{{ URL_DASHBOARD_MATERIAL_DO_EDIT }}">
                        <div class="form-group" style="display: none">
                            <label>ID</label>
                            <input name="material_id" class="form-control" value="{{ $material->id }}">
                        </div>

                        <div class="form-group" {!! is_null($material->id) ? "style=\"display: none;\"" : "" !!}>
                            <label>SN.</label>
                            <input name="material_sn" disabled class="form-control" value="{{ $siteVar['sn_prefix'] . str_pad($material->id, 3, '0', STR_PAD_LEFT) }}">
                        </div>

                        <div class="form-group">
                            <label>材質名稱 (100)</label>
                            <input name="material_name" class="form-control" value="{{ $material->name }}">
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
