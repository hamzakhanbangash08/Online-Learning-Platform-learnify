<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Header Include --}}
    @include('layouts.header')
</head>
<body>
    <div class="container-scroller">

        {{-- Top Banner --}}
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">
                                Free 24/7 customer support, updates, and more with this template!
                            </p>
                            <a href="https://www.bootstrapdash.com/product/stellar-admin-template/"
                               target="_blank"
                               class="btn me-2 buy-now-btn border-0">
                                Buy Now
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/stellar-admin-template/">
                            <i class="icon-home me-3 text-white"></i>
                        </a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="icon-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navbar --}}
        @include('layouts.navbar')

        <div class="container-fluid page-body-wrapper">

            {{-- Sidebar --}}
            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                  @yield('page-title')

                    {{-- Flash Messages --}}
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    {{-- Main Page Content --}}
                    @yield('content')
                </div>

                {{-- Footer --}}
                @include('layouts.footer')

            </div>
        </div>
    </div>

    {{-- Vendor JS --}}
    <!-- <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script> -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

    {{-- Template JS --}}
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    {{-- Bootstrap 5 Bundle --}}

<!-- Flowbite JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.1/flowbite.min.js"></script> -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js"></script>



<script>
    $(document).ready(function () {
        $('#mytable').DataTable();
    });
</script>
    {{-- Page Specific Scripts --}}
    @yield('scripts')
</body>
</html>
