<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/hotelier/booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Mar 2025 08:05:02 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <title>GeniusHotel | Booking</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
     <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg-3 bg-dark d-none d-lg-block">
                <a href="{{ url('/') }}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 text-primary text-uppercase">GeniusHotel</h1>
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row gx-0 bg-white d-none d-lg-flex">
                    <div class="col-lg-7 px-5 text-start">
                        <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                            <i class="fa fa-envelope text-primary me-2"></i>
                            <p class="mb-0">mbaga0345@gmail.com</p>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center py-2">
                            <i class="fa fa-phone-alt text-primary me-2"></i>
                            <p class="mb-0">(+255) 681 969 339</p>
                        </div>
                    </div>
                    <div class="col-lg-5 px-5 text-end">
                        <div class="d-inline-flex align-items-center py-2">
                            <a class="me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="me-3" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="me-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="me-3" href="#"><i class="fab fa-instagram"></i></a>
                            <a class="" href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                    <a href="{{ url('/') }}" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 text-primary text-uppercase">GeniusHotel</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ url('about-us') }}" class="nav-item nav-link">About</a>
                            <a href="{{ url('services') }}" class="nav-item nav-link">Services</a>
                            <a href="{{ url('pricing') }}" class="nav-item nav-link">Pricing</a>
                            <a href="{{ url('our-rooms') }}" class="nav-item nav-link">Rooms</a>
                            <a href="{{ url('contact') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        @auth
                           <a style="margin-left:150px;" class="btn btn-primary py-2 px-3 mt-1" href="{{ route('logout') }}">Logout</a>
                           <a style="margin-right:150px;" class="btn btn-primary py-2 px-3 mt-1" href="{{ route('booking.form') }}">Booking</a>
                       @else
                           <!-- User is not logged in, show only Start a Free Trial button -->
                           <a style="margin-right:150px;" class="btn btn-primary py-2 px-3 mt-1" href="#">Start a Free Trial</a>
                       @endauth
                    
                    </div>
                </nav>
            </div>
        </div>
    </div>
    
    <!-- Header End -->


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{ asset('Home-assets/img/carousel-1.jpg')}});">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Booking</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Booking Start -->
        {{-- <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="date" id="date2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Adult</option>
                                        <option value="1">Adult 1</option>
                                        <option value="2">Adult 2</option>
                                        <option value="3">Adult 3</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select">
                                        <option selected>Child</option>
                                        <option value="1">Child 1</option>
                                        <option value="2">Child 2</option>
                                        <option value="3">Child 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End --> --}}

        @include('alerts.error')
        @include('alerts.success')
        @include('alerts.warning')
        <!-- Booking Start -->
      <!-- Booking Start -->
      <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                <h1 class="mb-5">Book A <span class="text-primary text-uppercase">Luxury Room</span></h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="{{asset('Home-assets/img/about-1.jpg')}}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="{{asset('Home-assets/img/about-2.jpg')}}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="{{asset('Home-assets/img/about-3.jpg')}}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="{{asset('Home-assets/img/about-4.jpg')}}">
                        </div>
                    </div>
                </div>

                @include('alerts.error')
                @include('alerts.success')
                @include('alerts.warning')
                
                
                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <form id="booking-form" action="{{ route('booking.form') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <!-- Name, Email, Phone fields -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                        <label for="name">Your Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                        <label for="email">Your Valid Email</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" required>
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>
                        
                                <!-- Check-in, Check-out date fields -->
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="checkin" id="checkin" placeholder="Check In" required>
                                        <label for="checkin">Check In</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date4" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input" name="checkout" id="checkout" placeholder="Check Out" required>
                                        <label for="checkout">Check Out</label>
                                    </div>
                                </div>
                        
                                <!-- Adults, Children fields -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="adults" id="adults" placeholder="Enter Adult Number" required>
                                        <label for="adults">Adult Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" name="children" id="children" placeholder="Enter Children's Number">
                                        <label for="children">Children Number</label>
                                    </div>
                                </div>
                        
                                <!-- Room Selection (Dropdown will be updated by AJAX) -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="room_id" name="room_id" required>
                                            <option value="">--Select Room--</option>
                                            <!-- Room options will be dynamically added here via AJAX -->
                                        </select>
                                        <label for="room_id">Select A Room</label>
                                    </div>
                                </div>
                        
                                <!-- Special Request -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="special_request" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                        
                                <!-- Hidden inputs to send booking info to Stripe -->
                                <input type="hidden" name="room_price" value="1000"> <!-- Example room price, replace with dynamic value -->
                                <input type="hidden" name="booking_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->
        
        <!-- Booking End -->


   <br>
   <br>
   <br>
   <br>
        

        <!-- Footer Start -->
   <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-primary rounded p-4">
                            <a href="index.html"><h1 class="text-white text-uppercase mb-3">GeniusHotel</h1></a>
                            <p class="text-white mb-0">
								Step into a world of unparalleled luxury and sophistication where every detail is 
                            crafted to offer you an extraordinary stay.
							</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Kilimanjaro, Tanzania</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(+255) 681 969 339</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>mbaga0345@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <div class="col-md-6">
                                <h6 class="section-title text-start text-primary text-uppercase mb-4">Company</h6>
                                <a  href="{{ url('about-us') }}" class="nav-item nav-link text-white">About</a>
                                <a href="{{url('services')}}" class="nav-item nav-link text-white">Services</a>
                                <a href="{{ url('pricing') }}" class="nav-item nav-link">Pricing</a>
                                <a href="{{ url('our-rooms') }}" class="nav-item nav-link text-white">Rooms</a>
                                <a href="{{ url('contact') }}" class="nav-item nav-link text-white">Contact</a>
                            </div>
                            <div class="col-md-6">
                                <h6 class="section-title text-start text-primary text-uppercase mb-4">Services</h6>
                                <a class="btn btn-link" href="#">Food & Restaurant</a>
                                <a class="btn btn-link" href="#">Spa & Fitness</a>
                                <a class="btn btn-link" href="#">Sports & Gaming</a>
                                <a class="btn btn-link" href="#">Event & Party</a>
                                <a class="btn btn-link" href="#">GYM & Yoga</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">GeniusHotel</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="#">Tech Genius</a>
                            <br>Distributed By: <a class="border-bottom" href="#" target="_blank">Tech Genius</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                {{-- <a href="#">Home</a>
                                <a href="#">Cookies</a>
                                <a href="#">Help</a>
                                <a href="#">FQAs</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

 <!-- Add jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    $(document).ready(function() {
        function fetchRooms(checkinDate = null, checkoutDate = null) {
            $.ajax({
                url: "{{ route('booking.checkAvailability') }}",
                method: "GET",
                data: {
                    checkin: checkinDate,
                    checkout: checkoutDate
                },
                success: function(response) {
                    var roomSelect = $('#room_id');
                    roomSelect.empty();
                    roomSelect.append('<option value="">Select a Room</option>');

                    if (response.success) {
                        $.each(response.rooms, function(index, room) {
                            roomSelect.append('<option value="' + room.id + '">' + room.name + '</option>');
                        });
                    } else {
                        roomSelect.append('<option value="">No rooms available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching room data: " + error);
                }
            });
        }

        // Load all rooms when the page first loads
        fetchRooms();

        // Handle date selection
        $('#checkin, #checkout').on('change', function() {
            var checkinDate = $('#checkin').val();
            var checkoutDate = $('#checkout').val();

            if (checkinDate && checkoutDate) {
                fetchRooms(checkinDate, checkoutDate);
            }
        });
    });
</script>



    
</body>
</html>