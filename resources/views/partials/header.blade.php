<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #001b48;">
  <div class="container">
    <a href="/"><img src="{{ asset('assets/images/logos/dark_logo_cropped.png') }}" alt="" style="width: 156px;margin-right: 10px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item active">
          <a class="nav-link headerLink" href="/">Anasayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/universiteler">Üniversiteler</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sehirler">Şehirler</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum">Forum</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="/ilanlar">İlanlar</a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Haberler</a>
        </li> --}}
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/kullanici_bilgileri">Kullanıcı Bilgileri</a>
            {{-- <a class="dropdown-item" href="#">Hesap Ayarları</a> --}}
            {{-- <a class="dropdown-item" href="#">Genel Ayarlar</a> --}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">Çıkış Yap</a>
          </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/login">Giriş Yap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Kayıt Ol</a>
        </li>
        @endauth
        {{-- <li class="nav-item d-none d-lg-block">
          <a class="nav-link" href="#" id="fullscreen-button">
            <i class="mdi mdi-fullscreen"></i>
          </a>
        </li> --}}
      </ul>
    </div>
  </div>
</nav>


<style>
.nav-link {
  font-size: 14px;
  color:#fff !important;
  margin: 0px 10px;
  width: 100%;
  text-align: center;
  border-radius: 10px;
  
}

.nav-link:hover {
  color: #001b48 !important;
  background-color: #fff !important;
  border-color: #001b48 !important;
  border-radius: 10px;
}

.dropdown-item{
  color: #001b48 !important;
}

</style>