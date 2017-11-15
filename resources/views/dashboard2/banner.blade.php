@extends('dashboard2.layout')

@section('title', 'BANNER | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('dashboard2.include.alert')

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hover Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="banner-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Banner Url</th>
                            <th>Banner Image</th>
                            <th>option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i=1; $i<=5; $i++)
                            <tr>
                                <td headers="no">{{ $i }}</td>
                                @if(isset($banner[$i]))
                                    <td headers="value">{{ $banner[$i]->value }}</td>
                                    <td><img src="{{ IMAGE_URL . $banner[$i]->value }}" /></td>
                                @else
                                    <td headers="value"></td>
                                    <td></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-default" onclick="bannerDel(this);"><i class="fa fa-remove"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <form id="del-banner" method="post" action="{{ URL_DASHBOARD2_BANNER_DO_DEL }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="no" value="">
    </form>

@endsection

@section('inner-js')
    <script>
        var bannerDel = function(el) {
            var rowTr = $(el).closest("tr");
            var bannerNo = rowTr.find('td[headers="no"]').text();
            var bannerValue = rowTr.find('td[headers="value"]').text();
            if (bannerValue == '') {
                $('#alert-object').attr('class', 'alert alert-info alert-dismissible');
                $('#alert-object p').text('Nothing to do ...');
                $('#alert-object').show();
                return;
            }

            var message = '是否確認刪除 NO.' + bannerNo;

            $('#del-banner').find('input[name="no"]').val(bannerNo);

            $('#modal-object').attr('class', 'modal modal-warning fade');
            $('#modal-object').find('.modal-header .modal-title').text('確認刪除');
            $('#modal-object').find('.modal-body p').text(message);
            $('#modal-object').modal('show');
        };

        $('#modal-object #modal-confirm').on('click', function() {
            document.querySelector('#del-banner').submit();
        });

        $(function () {
            $('#banner-table').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'columnDefs': [
                    {targets: [0], width: '50px'},
                    {targets: [1], className: 'hide_column'},
                    {targets: [3], width: '100px'}
                ]
            });
        })
    </script>
@endsection