{{--
alert-danger
alert-info
alert-warning
alert-success
--}}
@if(session()->has('message'))
    @php($alertType = session()->get('message')['class'])
    @php($alertContent = session()->get('message')['content'])
@endif

<div id="alert-object" class="alert {{ $alertType or 'alert-info' }} alert-dismissible" @if(!session()->has('message')) style="display: none" @endif>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{--<h4><i class="icon fa fa-check"></i> Alert!</h4>--}}
    <p>{{ $alertContent or '' }}</p>
</div>