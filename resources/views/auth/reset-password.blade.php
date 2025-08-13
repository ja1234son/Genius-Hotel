<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotelier') }} | Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('assets/images/logo.png')}}">

    <!-- Layout config Js -->
    <script src="{{ asset('login_assets/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('login_assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('login_assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('login_assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('login_assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .required {
            color: red;
        }
    </style>
</head>

<body>
    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover d-flex justify-content-center align-items-center min-vh-100 py-5">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content pt-lg-5 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 auth-one-bg h-100 p-4">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div  style="text-align:center;"  class="mb-4">
                                                <a href="{{ url('/') }}" class="d-block">
                                                    <img src="{{ asset('assets/images/logo.png') }}" alt=""
                                                        height="60">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner pb-5 text-center text-white">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean
                                                                design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with
                                                                an amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean
                                                                design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            {{-- <h5 class="text-primary">Welcome Back !</h5> --}}
                                            <p class="text-muted">
                                                {{ __('Enter your Email Address and create your new Password') }}
                                            </p>
                                        </div>
                                        @include('alerts.success')
                                        @include('alerts.error')
                                        @include('alerts.errors')
                                        @include('alerts.warning')
                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('password.store') }}">
                                                @csrf
                                                  <!-- Password Reset Token -->
                                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                                <div class="mb-3">
                                                    <label for="login" class="form-label">Email Address<span
                                                            class="required">*</span></label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ old('email') }}"
                                                        placeholder="Enter your email address">
                                                </div>

                                                  <div class="mb-3">
                                                    <label for="login" class="form-label">New Password<span
                                                            class="required">*</span></label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" value="{{ old('password') }}"
                                                        placeholder="Enter your new password">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="login" class="form-label">Confirm Password<span
                                                            class="required">*</span></label>
                                                    <input type="password" class="form-control" id="password_confirmation"
                                                        name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                        placeholder="Confirm your new password">
                                                </div>



                                                <input type="hidden" id="timezone" name="timezone">

                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" name="remember" type="checkbox" value=""
                                                        id="auth-remember-check">
           
                                                </div> --}}
                                                     <br>
                                                  
                                                <div class="mt-4">
                                                    <button  class="btn btn-warning w-100" type="submit">             
                                                           {{ __('Reset Password') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p style="color: #fff; font-weight:bold;" class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Tech Genius.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('login_assets/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('login_assets/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('login_assets/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('login_assets/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('login_assets/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('login_assets/assets/js/plugins.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('login_assets/assets/js/pages/password-addon.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#timezone').val(moment.tz.guess())
        });
    </script>
</body>

</html>
