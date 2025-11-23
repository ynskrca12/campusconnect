<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- SEO Metadata -->
  <title>@yield('title', 'Üniversite İletişim Ağı: Campus Connect')</title>
  <meta name="description" content="@yield('meta_description', 'Campus Connect - Kampüs hayatına dair bloglar, yorumlar ve güncel öneriler burada.')">
  <meta name="keywords" content="@yield('meta_keywords', 'campus, connect, blog')">
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <!-- End layout styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="{{ asset('public/assets/images/logos/dark_blank_cropped.png') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/css/common.css') }}">

  {{-- SweetAlert2 CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  @yield('css')

</head>
<body>
    <div class="container-scroller">
            @include('partials.header')
        <div class="{{ $containerClass ?? 'container' }} mt-4 min-vh-100">
            @yield('content')
            <x-user-preview-modal />
        </div>
        @include('partials.footer')
    </div>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  {{-- SweetAlert2 JS --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('public/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('public/assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('/assets/js/misc.js') }}"></script>
  <script src="{{ asset('/assets/js/general.js') }}"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  @yield('js')
</body>
</html>
