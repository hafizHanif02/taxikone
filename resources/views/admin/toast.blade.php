<div class="toastr-notice" id="toast-container">
    <div class="toast toast-{type}" data-autohide="true" data-delay="3000">
        <div class="toast-header">
            <strong class="mr-auto">{{ config('app.name') }}</strong>
            <small>Just now</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body">
            {message}
        </div>
    </div>
</div>

