<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'KahramanLawFirm')</title>

  @yield('css')  <!-- CSS'leri sayfaya dahil et -->
</head>
<body>

  @include('admin.partials.header')  <!-- Header'ı dahil et -->

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      @include('admin.partials.sidebar')  <!-- Sidebar'ı burada dahil ediyoruz -->

      <!-- Main content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
        @yield('content')  <!-- Dinamik içerik alanı -->
      </main>
    </div>
  </div>

  @include('admin.partials.footer')  <!-- Footer'ı dahil et -->

  @yield('js')  <!-- JS'leri sayfaya dahil et -->
</body>
</html>
