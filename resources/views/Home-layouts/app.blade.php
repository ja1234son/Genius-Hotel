<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>HOTELIER</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{url('assets/images/logo.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&amp;family=Montserrat:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="{{ asset('Home-assets/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ asset('Home-assets/cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('Home-assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('Home-assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('Home-assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('Home-assets/css/bootstrap.min.css')}}" rel="stylesheet">



    <!-- Template Stylesheet -->
    <link href="{{ asset('Home-assets/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
    @include('Home-layouts.nav-bar')
        <!-- Header End -->


  @yield('content')


        <!-- About Start -->
      @include('Home-layouts.about-us')
        <!-- About End -->


        <!-- Room Start -->
    @include('Home-layouts.rooms')
        <!-- Room End -->


        <!-- Video Start -->
@include('Home-layouts.video')
        <!-- Video Start -->


        <!-- Service Start -->
      @include('Home-layouts.service')
        <!-- Service End -->


        <!-- Testimonial Start -->
     @include('Home-layouts.testmonial')
        <!-- Testimonial End -->


        <!-- Team Start -->
      @include('Home-layouts.team')
        <!-- Team End -->


        <!-- Newsletter Start -->
      @include('Home-layouts.news')
        <!-- Newsletter Start -->


        <!-- Footer Start -->
      @include('Home-layouts.footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('Home-assets/code.jquery.com/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('Home-assets/cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('Home-assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('Home-assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>



    <!-- Template Javascript -->
    <script src="{{ asset('Home-assets/js/main.js') }}"></script>
</body>


</html>
