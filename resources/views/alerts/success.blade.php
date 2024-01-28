@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show" role="alert">
        <h3><i class="typcn typcn-input-checked"></i></h3><strong>Success:</strong>
        {{ $message }}
        <!-- <i class="fa fa-pencil"></i><strong>Success</strong> -->
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    </div>
@endif
