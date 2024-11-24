<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #001b48;">
  <div class="container">
    <a class="navbar-brand" href="/">CampusConnect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item active menu-title">
          <a class="nav-link" href="/">anasayfa</a>
        </li>
        <li class="nav-item menu-title">
          <a class="nav-link" href="/university">üniversiteler</a>
        </li>
        <li class="nav-item menu-title">
          <a class="nav-link" href="/forum">forum</a>
        </li>
        {{-- <li class="nav-item menu-title">
          <a class="nav-link" href="/ilanlar">İlanlar</a>
        </li> --}}
        {{-- <li class="nav-item menu-title">
          <a class="nav-link" href="#">Haberler</a>
        </li> --}}
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/kullanici_bilgileri">Kullanıcı Bilgileri</a>
            <a class="dropdown-item" href="#">Hesap Ayarları</a>
            <a class="dropdown-item" href="#">Genel Ayarlar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">Çıkış Yap</a>
          </div>
        </li>
        @else
        <li class="nav-item menu-title">
          <a class="nav-link" href="/login">giriş yap</a>
        </li>
        <li class="nav-item menu-title">
          <a class="nav-link" href="/register">kayıt ol</a>
        </li>
        @endauth
        <li class="nav-item d-none d-lg-block">
          <a class="nav-link" href="#" id="fullscreen-button">
            <i class="mdi mdi-fullscreen"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<style>
.nav-link {
  /* text-decoration: none;
  color: var(--secondary-color);
  font-weight: 300;
  border-radius: 8px;
  padding: 4px 22px;
  transition: background-color 0.3s, border-color 0.3s, color 0.3s; */

  font-size: 17px;
  color:#fff !important;
  margin: 0px 10px;
}

.nav-link:hover {
  /* color: #001b48;
  background-color: var(--secondary-color);
  border-color: var(--primary-color); */
}

</style>