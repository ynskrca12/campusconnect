<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001b48;">
  <div class="container">
    <a href="/"><img src="{{ asset('assets/images/logos/dark_logo_cropped.png') }}" alt="" style="width: 156px;margin-right: 10px"></a>
    
    <!-- Mobil Menü Butonu (Sadece Mobilde Göster) -->
    <button class="navbar-toggler custom-toggler d-lg-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Masaüstü Menü (Sadece Büyük Ekranlarda Göster) -->
    <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarNav">
      <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item mx-1">
            <a class="nav-link {{ Request::is('/') ? 'active-link' : '' }}" href="/">Anasayfa</a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link {{ Request::is('universiteler') ? 'active-link' : '' }}" href="/universiteler">Üniversiteler</a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link {{ Request::is('sehirler') ? 'active-link' : '' }}" href="/sehirler">Şehirler</a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link {{ Request::is('forum') ? 'active-link' : '' }}" href="/forum">Forum</a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link {{ Request::is('blog-makale') ? 'active-link' : '' }}" href="/blog-makale">Blog / Makale</a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link {{ Request::is('calisma-alanim') ? 'active-link' : '' }}" href="/calisma-alanim">Çalışma Alanım</a>
        </li>
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ Request::is('kullanici-bilgileri') || Request::is('istatistiklerim') || Request::is('begendiklerim') || Request::is('yorumlarim') ? 'active-link' : '' }}" href="#" id="userDropdownDesktop" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user me-2"></i>Hesabım
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item {{ Request::is('profil/*') ? 'active-link' : '' }}" 
                      href="/profil/{{ Auth::user()->username }}">
                        <i class="fa-solid fa-user me-2"></i>Profilim
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ Request::is('kullanici-bilgileri') ? 'active-link' : '' }}" href="/kullanici-bilgileri">
                        <i class="fa-solid fa-circle-info me-2"></i>Bilgilerim
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ Request::is('istatistiklerim') ? 'active-link' : '' }}" href="{{ route('my.statistics') }}">
                        <i class="fa-solid fa-chart-simple me-2"></i>İstatistiklerim
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ Request::is('begendiklerim') ? 'active-link' : '' }}" href="{{ route('my.likes') }}">
                        <i class="fa-solid fa-thumbs-up me-2"></i>Beğendiklerim
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ Request::is('yorumlarim') ? 'active-link' : '' }}" href="{{ route('my.comments') }}">
                        <i class="fa-solid fa-comments me-2"></i>Yorumlarım
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item mx-1"><a class="nav-link" href="/logout"><i class="fa-solid fa-power-off me-2"></i>Çıkış Yap</a></li>
        @else
        <li class="nav-item mx-1"><a class="nav-link {{ Request::is('login') ? 'active-link' : '' }}" href="/login">Giriş Yap</a></li>
        <li class="nav-item mx-1"><a class="nav-link {{ Request::is('register') ? 'active-link' : '' }}" href="/register">Kayıt Ol</a></li>
        @endauth
      </ul>
    </div>

    <!-- Mobil Menü -->
    <div class="custom-mobile-menu d-lg-none">
      <button class="close-menu">&times;</button>
      <ul class="mobile-nav-links">
        <li><a href="/">Anasayfa</a></li>
        <li><a href="/universiteler">Üniversiteler</a></li>
        <li><a href="/sehirler">Şehirler</a></li>
        <li><a href="/forum">Forum</a></li>

        @auth
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" id="userDropdownMobile"><i class="fas fa-user me-2"></i>Hesabım</a>
          <ul class="dropdown-menu-mobile">
            <li class="sub-menu"><a href="/kullanici-bilgileri"><i class="fa-solid fa-circle-info me-2"></i>Bilgilerim</a></li>
            <li class="sub-menu"><a href="{{ route('my.statistics') }}"><i class="fa-solid fa-chart-simple me-2"></i>İstatistiklerim</a></li>
            <li class="sub-menu"><a href="{{ route('my.likes') }}"><i class="fa-solid fa-thumbs-up me-2"></i>Beğendiklerim</a></li>
            <li class="sub-menu"><a href="{{ route('my.comments') }}"><i class="fa-solid fa-comments me-2"></i>Yorumlarım</a></li>
          </ul>
        </li>
        <li><a href="/logout"><i class="fa-solid fa-power-off me-2"></i>Çıkış Yap</a></li>
        @else
        <li><a href="/login">Giriş Yap</a></li>
        <li><a href="/register">Kayıt Ol</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<style>
  .navbar-nav .nav-link.active-link {
      color: #001b48 !important;
      background-color: #fff !important;
      border-color: #001b48 !important;
      border-radius: 10px;
  }

  .navbar-nav .nav-link{
    font-size: 14px;
    color: #fff !important;
    margin: 0px 10px;
    width: 100%;
    text-align: center;
    border-radius: 10px;
  }
  .navbar-nav .nav-link:hover {
    color: #001b48 !important;
    background-color: #fff !important;
    border-color: #001b48 !important;
    border-radius: 10px;
  }
/* Mobil Menü */
.custom-mobile-menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background-color: #001b48;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transform: translateY(-100%);
  transition: transform 0.3s ease-in-out;
  z-index: 1050;
}

.custom-mobile-menu.active {
  transform: translateY(0);
}

.mobile-nav-links {
  list-style: none;
  padding: 0;
}

.mobile-nav-links li {
  margin: 15px 0;
  font-size: 20px;
  color: #fff !important;
  padding: 10px 20px;
  transition: 0.3s ease-in-out;
}

.mobile-nav-links a {
  color: #fff;
  font-size: 20px;
  text-decoration: none;
  display: block;
}

.mobile-nav-links a:hover {
  color: #001b48;
  background-color: #fff;
  padding: 10px 15px;
  border-radius: 10px;
}

/* Hesabım Menüsü */
.dropdown-menu-mobile {
  display: none;
  list-style: none;
  padding-left: 0;
}

.dropdown-menu-mobile li {
  margin: 10px 0;
}

.dropdown-toggle {
  cursor: pointer;
}

.close-menu {
  position: absolute;
  top: 20px;
  right: 20px;
  background: none;
  border: none;
  font-size: 30px;
  color: white;
  cursor: pointer;
}

.navbar-toggler.custom-toggler {
  border: none;
  background: none;
  font-size: 24px;
  color: white;
}

.sub-menu {
  padding: 10px 0px !important;
}

/* Animasyon */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}

.custom-mobile-menu.active > .mobile-nav-links > li {
  animation: fadeIn 1.2s ease-in-out forwards;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const menuButton = document.querySelector(".navbar-toggler.custom-toggler");
  const mobileMenu = document.querySelector(".custom-mobile-menu");
  const closeButton = document.querySelector(".close-menu");
  const userDropdown = document.querySelector("#userDropdownMobile");
  const userMenu = document.querySelector(".dropdown-menu-mobile");

  // Mobil Menü Aç/Kapat
  menuButton.addEventListener("click", function () {
    mobileMenu.classList.add("active");
  });

  closeButton.addEventListener("click", function () {
    mobileMenu.classList.remove("active");
  });

  // Hesap Menüsünü Aç/Kapat (Mobil)
  if (userDropdown) {
    userDropdown.addEventListener("click", function (e) {
      e.preventDefault();
      userMenu.style.display = userMenu.style.display === "block" ? "none" : "block";
    });
  }
});
</script>
