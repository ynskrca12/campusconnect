<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CampusConnect</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
 
  <!-- End layout styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" href="{{ asset('public/assets/images/cc.png') }}" />
  
  @yield('css')

</head>
<body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        @include('partials.header')
      </nav>
    <div class="container-fluid page-body-wrapper">
            <div class="content-wrapper">
                 @yield('content')
            </div>
    </div>
    @include('partials.footer')
</div>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="{{ asset('public/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('public/assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('public/assets/js/misc.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  @yield('js')
</body>
</html>
