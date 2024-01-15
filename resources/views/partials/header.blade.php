
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: #001B48;">
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <div class="logo" style="margin-left: 30px">
            <a href="/" class="link link-brand">
                <span class="logo-text">CampusConnect</span>
            </a>
        </div>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item" >
        <a class="nav-link" href="/">
          <span class="menu-title">Anasayfa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/universite">
          <span class="menu-title">Üniversiteler</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span class="menu-title">Etkinlikler</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="/duyurular">
          <span class="menu-title">Duyurular</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="/ilanlar">
          <span class="menu-title">İlanlar</span>
        </a>
      </li>
      @auth
      {{-- Kullanıcı giriş yapmışsa --}}
      <li class="nav-item dropdown">
        <div class="dropdown">
          <a class="nav-link dropbtn" href="#" id="userDropdown">
            <span class="menu-title"> <i class="fas fa-user"></i> </span>
          </a>
          <div class="dropdown-content" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/kullanici_bilgileri">Kullanıcı Bilgileri</a>
            <a class="dropdown-item" href="#">Hesap Ayarları</a>
            <a class="dropdown-item" href="#">Genel Ayarlar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/logout">Çıkış Yap</a>
          </div>
        </div>
      </li>
    @else
      {{-- Kullanıcı giriş yapmamışsa --}}
      <li class="nav-item">
        <a class="nav-link" href="/login">
          <span class="menu-title">Giriş Yap</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/register">
          <span class="menu-title">Kayıt Ol</span>
        </a>
      </li>
    @endauth
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
    </ul>
  </div>
</nav>

<style>
/* Dropdown container */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown button style */
.dropbtn {
  background-color: #001B48;
  color: white;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: #001B48;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #001B48;
  color: white;

}

.dropdown:hover .dropdown-content {
  display: block;

}

  </style>
