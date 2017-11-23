{{--
empty 先不要用button class不同
modal-primary
modal-info
modal-warning
modal-danger
modal-success

// Init modal-object
$('#modal-object').attr('class', 'modal fade');
$('#modal-object').find('.modal-header .modal-title').text('title');
$('#modal-object').find('.modal-body p').text('body');
$('#modal-object').modal('show');
--}}
<div class="modal fade" id="modal-object">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button id="modal-confirm" type="button" class="btn btn-outline">Confirm</button>
            </div>
        </div>
    </div>
</div>
