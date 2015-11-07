@if(Session::has('message_error'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">
            &times;
        </button>
        <b>{{ Session::get('message_error') }}</b>
    </div>
@endif