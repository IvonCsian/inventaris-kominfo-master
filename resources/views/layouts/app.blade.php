<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/feather/feather.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/typicons/typicons.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('') }}assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('') }}assets/js/select.dataTables.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        @stack('css')
        <link rel="stylesheet" href="{{ asset('') }}assets/css/vertical-layout-light/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('') }}assets/images/favicon.png" />
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            @include('components.partials._navbar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
              <!-- partial:partials/_settings-panel.html -->
              @include('components.partials._settings-panel')
              <!-- partial -->
              <!-- partial:partials/_sidebar.html -->
              @include('components.partials._sidebar')
              <!-- partial -->
              <div class="main-panel">
                <div class="content-wrapper">
                  @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('components.modal-logout')
                @include('components.partials._footer')
                <!-- partial -->
              </div>
              <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
    </body>
    <!-- plugins:js -->
    <script src="{{ asset('') }}assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('') }}assets/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('') }}assets/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('') }}assets/js/off-canvas.js"></script>
    <script src="{{ asset('') }}assets/js/hoverable-collapse.js"></script>
    <script src="{{ asset('') }}assets/js/template.js"></script>
    <script src="{{ asset('') }}assets/js/settings.js"></script>
    <script src="{{ asset('') }}assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('') }}assets/js/dashboard.js"></script>
    <script src="{{ asset('') }}assets/js/Chart.roundedBarCharts.js"></script>
     <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- End custom js for this page-->
    @stack('js')
</html>
