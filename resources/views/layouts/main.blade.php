<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  
    @include('partials.head')

</head>

<body class="g-sidenav-show  bg-gray-200">
  
    @include('partials.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('partials.navbar')
    
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield('content')
      
      @include('partials.footer')

    </div>
  </main>
  
  <!--   Core JS Files   -->
  @include('partials.scripts')

  {{-- Datatables --}}
  <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>

</body>

</html>