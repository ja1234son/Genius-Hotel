@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible alert-label-icon rounded-label fade show" role="alert">
        <h3><i class="comment-alert-outline"></i></h3><strong>Warning!::</strong> -
        {{ $message }}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    </div>
@endif
