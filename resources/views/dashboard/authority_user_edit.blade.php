@extends('dashboard.layout')

@section('title', '日何百鐵')

@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    權限管理-編輯
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="post" action="#">

                    <div class="form-group">
                        <label>ID</label>
                        <input name="user_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>信箱</label>
                        <input name="user_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>名稱</label>
                        <input name="user_name" class="form-control">
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
