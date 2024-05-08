<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="NettaAdChip : Crypto Bootstrap Admin Template" />
	<meta property="og:title" content="NettaAdChip : Crypto Bootstrap Admin Template" />
	<meta property="og:description" content="NettaAdChip : Crypto Bootstrap Admin Template" />

	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>HOTELIER</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{url('assets/images/logo.png')}}" />

	<link href="{{url('assets/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	<link href="{{url('assets/vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">

    <!-- Datatable -->
    <link href="{{url('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">

    <!-- Sweetalert -->
    <link href="{{url('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

     <!-- Toastr -->
     <link rel="stylesheet" href="{{url('assets/vendor/toastr/css/toastr.min.css')}}">

	<!-- Style css -->
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

</head>
<body>


        <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
			<span>H</span>
			<span>O</span>
			<span>T</span>
			<span>E</span>
			<span>L</span>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
					<img src="{{url('assets/images/logo.png')}}" alt="logo" style="width:70%">

            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->
@include('layouts.widgets')
		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
@include('layouts.navbar')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
@include('layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
@yield('content')
        <!--**********************************
            Content body end
        ***********************************-->



        <!--**********************************
            Footer start
        ***********************************-->
@include('layouts.footer')
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>


<script src="{{url('assets/vendor/global/global.min.js')}}"></script>
<script src="{{url('assets/vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{url('assets/vendor/apexchart/apexchart.js')}}"></script>
<script src="{{url('assets/vendor/owl-carousel/owl.carousel.js')}}"></script>

<!-- Dashboard 1 -->
<script src="{{url('assets/js/dashboard/dashboard-1.js')}}"></script>

    <!-- Datatable -->
    <script src="{{url('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins-init/datatables.init.js')}}"></script>

    <!-- Sweetalert -->
    <script src="{{url('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{url('assets/js/plugins-init/sweetalert.init.js')}}"></script>

     <!-- Toastr -->
     <script src="{{url('assets/vendor/toastr/js/toastr.min.js')}}"></script>

     <!-- All init script -->
     <script src="{{url('assets/js/plugins-init/toastr-init.js')}}"></script>


<script src="{{url('assets/js/custom.min.js')}}"></script>
<script src="{{url('assets/js/deznav-init.js')}}"></script>
<script src="{{url('assets/js/demo.js')}}"></script>
<script src="{{url('assets/js/styleSwitcher.js')}}"></script>
<!-- End custom js for this page-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
