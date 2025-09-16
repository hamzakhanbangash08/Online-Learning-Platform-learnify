
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->


    <!--  -->
 <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icons.min.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

    <!--  -->
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartist/chartist.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-light-layout/style.css') }}">
    <!-- End layout styles -->
    <!-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" /> -->

    <link rel="icon" href="{{ asset(setting('favicon', 'favicon.ico')) }}">




    <!-- cdn about icon and datatables -->
     <!-- Flowbite CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.1/flowbite.min.css" rel="stylesheet" />

<!-- FontAwesome Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- DataTables CSS (Bootstrap 5 integration)  -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 JS -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

<!-- Summernote CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<style>
  .profile-pic {
    width: 40px; /* Adjust the width as needed */
    height: 40px; /* Adjust the height as needed */
    object-fit: cover; /* Ensures the image covers the area without distortion */

  }

   .dropdownsystem {
    width: 100px; /* Adjust the width as needed */
    height: 100px; /* Adjust the height as needed */
    object-fit: cover; /* Ensures the image covers the area without distortion */
    margin-left: 36px;

  }


  /* Sidebar fixed full height for desktop */
.sidebar {
    position: fixed;
    top: 69px;
    bottom: 0;
    left: 0;
    height: 100vh;
    overflow-y: auto;
    width: 240px; /* sidebar width */
    transition: all 0.3s ease;
    z-index: 1000; /* navbar ke upar */
}

/* Reserve space for content (desktop only) */
.page-body-wrapper {
    margin-left: 250px; /* same as sidebar width */
    transition: all 0.3s ease;
}

/* Main panel scroll kare */
.main-panel {
    height: 100vh;
    overflow-y: auto;
    padding-bottom: 50px;
}

/* ✅ Mobile / Small screen fix */
@media (max-width: 991px) {
    .sidebar {
        left: -250px; /* hide sidebar */
    }
    .sidebar.active {
        left: 0; /* show when toggled */
    }
    .page-body-wrapper {
        margin-left: 0; /* no space on small screen */
    }
}


.button-primary{
    background-color: aqua;
    color: white;
}


/* form */
/* Import a modern font from Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body {
    background-color: #f0f2f5;
    font-family: 'Poppins', sans-serif;
    color: #4a4a4a;
}

.card {
    border: none;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Header Gradient Style */
.card-header-gradient {
    background: linear-gradient(90deg, #4e73df, #5a5cd1);
    color: #ffffff;
    border-bottom: 2px solid #3c5bb2;
}

/* Form control styling */
.form-control, .form-select {
    border: 1px solid #ced4da;
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #5a5cd1;
    box-shadow: 0 0 0 0.25rem rgba(90, 92, 209, 0.25);
}


/* Primary Button Styling */
.button-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    color: #fff;
    border: none;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.button-primary:hover {
    background: linear-gradient(45deg, #224abe, #4e73df);
    transform: translateY(-2px);
    color: #fff;
}

/* Link styling */
.form-text a {
    color: #4e73df;
    text-decoration: none;
    transition: color 0.2s ease;
}

.form-text a:hover {
    color: #224abe;
    text-decoration: underline;
}


</style>
  @yield('styles')
