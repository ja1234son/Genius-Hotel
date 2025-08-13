         {{-- @if (session('status'))
                                         <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                                 {{ session('status') }}
                                                  </div>
                                               @endif --}}

                                               @if ($message = Session::get('status'))
    <div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show"  role="alert">
        <h3><i class="typcn typcn-input-checked"></i></h3><strong>Success:</strong>
        {{ $message }}
        <!-- <i class="fa fa-pencil"></i><strong>Success</strong> -->
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    </div>
@endif