@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show" role="alert">
        <h3><i class="typcn typcn-lock-closed-outline"></i></h3><strong>Whoops!</strong> There`s something went wrong.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    </div>
@endif
