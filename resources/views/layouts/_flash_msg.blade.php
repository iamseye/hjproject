@if(Session::has('flash_msg'))
<div class="alert alert-{{Session::has('fail_msg')?'danger':'success'}} alert-dismissible fade in {{Session::has('flash_msg_important')?'alert-important':''}}" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('flash_msg') }}
</div>
@endif
