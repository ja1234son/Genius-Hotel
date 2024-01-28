<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themewagon.github.io/celestialAdmin-free-admin-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Oct 2023 07:59:20 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HOTELIER</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{url('assets/vendors/typicons.font/font/typicons.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendors/css/vendor.bundle.base.css')}}">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('assets/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{url('assets/images/logo.png')}}" />

</head>
<body>
<div class="row" id="proBanner">
    <i class="typcn typcn-delete-outline" id="bannerClose"></i>
</div>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
       @include('layouts.settings')
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
       @include('layouts.sidebar')
        <!-- partial -->
        <div class="main-panel">
         @yield('content')
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
           @include('layouts.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="{{url('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{url('assets/js/off-canvas.js')}}"></script>
<script src="{{url('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{url('assets/js/template.js')}}"></script>
<script src="{{url('assets/js/settings.js')}}"></script>
<script src="{{url('assets/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="{{url('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{url('assets/vendors/chart.js/Chart.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{url('assets/js/dashboard.js')}}"></script>
<!-- End custom js for this page-->

<!-- DataTable js links -->
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
{{--<script src="js/sb-admin-2.min.js"></script>--}}

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
</body>

<!-- Mirrored from themewagon.github.io/celestialAdmin-free-admin-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Oct 2023 07:59:36 GMT -->
</html>
