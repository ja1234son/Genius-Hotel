@if ($message = Session::get('error'))
{{-- <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert"> --}}
                                                        <span class="alert-icon">
                                                           <h3><i class=""></i></h3>
                                                        </span>
                                                        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button> --}}
                                                           <div class="alert alert-danger">
                                                            <strong>Error::!</strong> {{ $message }}.
                                                           </div>
                                                    {{-- </div> --}}
@endif
