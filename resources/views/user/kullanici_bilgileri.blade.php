@extends('layouts.master')

@section('content')
  @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <div class="row">
      <!-- Profile Header -->
      {{-- <div class="col-12 mb-4 text-center">
         
      </div> --}}

      <!-- Main Content -->
      <div class="col-12">
          <div class="card border-0 shadow-sm">
              <div class="card-body p-0">
                  <div class="row g-0">
                      <!-- Sidebar -->
                      <div class="col-lg-3 border-end text-center">
                        <div class="position-relative d-inline-block">
                          <img src="{{ asset('assets/images/user.png') }}" class="rounded-circle profile-pic" alt="Profile Picture" style="width: 70px;">
                          <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 rounded-circle">
                              <i class="fas fa-camera"></i>
                          </button>
                      </div>
                      <h5 class="mt-3 mb-1">{{ Auth::user()->name }}</h5>
                          <div class="p-4">
                              <div class="nav flex-column nav-pills">
                                  <a class="nav-link nav-link-profile active" id="bilgilerim-tab" href="#" data-target="#bilgilerim"><i class="fas fa-user me-2"></i>Bilgilerim</a>
                                  <a class="nav-link nav-link-profile" id="istatistiklerim-tab" href="#" data-target="#istatistiklerim"><i class="fas fa-chart-line me-2"></i>İstatistiklerim</a>
                              </div>
                          </div>
                      </div>

                      <!-- Content Area -->
                      <div class="col-lg-9">
                          <div class="p-4">
                              <div id="bilgilerim" class="content-section">
                                  <h5 class="mb-4">Bilgilerim</h5>
                                  <div class="row g-3">
                                      <div class="col-md-6">
                                          <label class="form-label">Kullanıcı Adı</label>
                                          <input type="text" class="form-control" value="{{$user->username}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">Ad Soyad</label>
                                          <input type="text" class="form-control" value="{{$user->name}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">E-Posta</label>
                                          <input type="email" class="form-control" value="{{$user->email}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label class="form-label">Üniversite</label>
                                          <input type="text" class="form-control" value="{{$user->university}}">
                                      </div>
                                  </div>
                              </div>
                              
                              <div id="istatistiklerim" class="content-section d-none">
                                  <h5 class="mb-4">İstatistiklerim</h5>
                                  {{-- <ul class="list-group">
                                      <li class="list-group-item">Beğendiğim yorumlar: <span id="liked-comments-count">15</span></li>
                                      <li class="list-group-item">Toplam yaptığım yorumlar: <span id="total-comments-count">30</span></li>
                                      <li class="list-group-item">Yorumlarımın aldığı beğeni sayısı: <span id="my-comments-likes">45</span></li>
                                      <li class="list-group-item">Yorumlarıma yapılan yanıt sayısı: <span id="my-comments-replies">10</span></li>
                                  </ul> --}}

                                  <div class="d-flex flex-column align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-spinner fa-spin fa-3x text-primary mb-3"></i>
                                    <p class="text-muted">Yakında tüm istatistikler burada olacak...</p>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@section('css')
<style>
  
    .nav-pills .nav-link {
        color: #6c757d !important;
        border-radius: 10px;
        padding: 12px 20px;
        margin: 4px 0;
        text-align: left;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }

    .nav-pills .nav-link.active {
        background-color: #fff;
        color: #001B48 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-label{
      font-weight: 600;
      font-family: monospace;
      font-size: 16px;
    }

    .dropdown-menu[data-bs-popper]{
      left: -55px;
      top: 55px;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".nav-link-profile").click(function (e) {
            e.preventDefault();
            $(".nav-link-profile").removeClass("active");
            $(this).addClass("active");
            
            $(".content-section").addClass("d-none");
            let target = $(this).data("target");
            $(target).removeClass("d-none");
        });
    });
</script>
@endsection